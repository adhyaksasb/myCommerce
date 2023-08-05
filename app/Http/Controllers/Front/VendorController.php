<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Vendor;
use Validator;
use DB;

class VendorController extends Controller
{
    public function loginRegister() {
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Validate Vendor
            $rules = [
                "name" => "required",
                "email" => "required|email|unique:admins|unique:vendors",
                "mobile" => "required|unique:admins|unique:vendors",
                "accept" => "required",
            ];

            $customMessages = [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "email.email" => "Valid Email is required",
                "email.unique" => "Email already exists",
                "mobile.required" => "Mobile Number is required",
                "mobile.unique" => "Mobile Number already exists",
                "accept.required" => "Please accept Terms & Conditions",
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            
            // Create Vendor Account
            DB::beginTransaction();

            // Insert into Vendors Table
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->email_confirmed = "No";
            $vendor->status = 0;
            $vendor->save();

            // Insert into Admins Table
            $vendor_id = DB::getPdo()->lastInsertId();

            $admin = new Admin;
            $admin->type = "vendor";
            $admin->vendor_id = $vendor_id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->email_confirmed = "No";
            $admin->status = 0;
            $admin->save();

            // Send Confirmation Email
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'name' => $data['name'],
                'code' => base64_encode($data['email']),
            ];

            Mail::send('front.emails.vendor_confirmation', $messageData, function($message)use($email) {
                $message->to($email)->subject('Confirm your myCommerce Vendor Account');
            });

            DB::commit();

            // Redirect back Vendor with Success Message
            $message = "Thanks for registering as a Vendor. Please confirm your email to activate your account.";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function confirmVendor($email) {
        // Decode Vendor Email
        $email = base64_decode($email);

        // Check Vendor Email Exists
        $vendorCount = Vendor::where('email', $email)->count();
        if($vendorCount>0) {
            // Vendor Email is already activated or not
            $vendorDetails = Vendor::where('email',$email)->first();
            if($vendorDetails->email_confirmed == "Yes") {
                $message = "Your Vendor Account is already activated. You can login with your registered account.";
                return redirect('vendor/login-register')->with('error_message', $message);
            }else {
                // Update email_confirmed to Yes in both admins and vendor tables
                Admin::where('email', $email)->update(['email_confirmed'=>'Yes']);
                Vendor::where('email', $email)->update(['email_confirmed'=>'Yes']);

                // Send Register Email
                $messageData = [
                    'email' => $email,
                    'name' => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile,
                ];

                Mail::send('front.emails.vendor_confirmed', $messageData, function($message)use($email) {
                    $message->to($email)->subject('myCommerce Vendor Account is Activated');
                });

                // Redirect to Vendor Login / Register Page with Success Message
                $message = "Your Vendor Email account is activated. You can login and complete your personal, business, and bank details to start selling your products.";
                return redirect('vendor/login-register')->with('success_message', $message);
            }
        }else {
            abort(404);
        }
    }
}
