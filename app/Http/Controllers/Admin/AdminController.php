<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;
use Auth;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
use App\Models\Country;
use Mail;
use Image;
use Session;

class AdminController extends Controller
{
    public function dashboard() {
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            // if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1] )) {
            //     return redirect('admin/dashboard');
            // }else {
            //     return redirect()->back()->with('error_message','Invalid Email or Password');
            // }

            
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']] )) {
                if(Auth::guard('admin')->user()->type=="vendor" && Auth::guard('admin')->user()->email_confirmed=="No") {
                    return redirect()->back()->with('error_message', 'Please confirm your email to activate your Vendor Account.');
                }else if (Auth::guard('admin')->user()->type!="vendor" && Auth::guard('admin')->user()->status=="0") {
                    return redirect()->back()->with('error_message','Your admin account is not active.');
                }else {
                    return redirect('admin/dashboard');
                }
            }else {
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function updateAdminPassword(Request $request) {
        Session::put('page','update_admin_password');
        if($request->isMethod('post')) {
            $data = $request->all();
            //Check if current password entered is correct
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // Check if new password is matching with confirm password
                if($data['new_password']==$data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message','Password has been updated!'); 
                }else {
                    return redirect()->back()->with('error_message','New Password and Confirm Password does not match!');
                }
            }else {
                return redirect()->back()->with('error_message','Your current password is Incorrect!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        }else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request) {
        Session::put('page','update_admin_details');
        if($request->isMethod('post')) {
            $data = $request->all();

            $validated = $request->validate([
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ]);
                    
            // Update Admin Photo
            if($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);

                    if(!empty($data['current_admin_image'])) {
                        $image_path = 'admin/images/photos/'.$data['current_admin_image'];

                        if(file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                }
            }else if(!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            }else {
                $imageName = "";
            }

            // Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
            return redirect()->back()->with('success_message','Admin Details has been updated!');
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_details')->with(compact('adminDetails'));
    }

    public function updateVendorDetails($slug, Request $request) {
        if($slug == "personal") {
            Session::put('page','personal');
            if($request->isMethod('post')) {
                $data = $request->all();

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                    'vendor_address' => 'required',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pin' => 'required',
                ];

                $messages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_mobile.required' => 'Mobile Number is required',
                    'vendor_address.required' => 'Address is required',
                    'vendor_city.required' => 'City is required',
                    'vendor_state.required' => 'State is required',
                    'vendor_country.required' => 'Country is required',
                    'vendor_pin.required' => 'Pin Code is required',
                    'vendor_name.regex' => 'Please enter valid name',
                    'vendor_city.regex' => 'Please enter valid City',
                    'vendor_state.regex' => 'Please enter valid State',
                    'vendor_country.regex' => 'Please enter valid Country'
                ];

                $this->validate($request, $rules, $messages);
                        
                // Update Admin Photo
                if($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if($image_tmp->isValid()) {
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        // Upload the Image
                        Image::make($image_tmp)->save($imagePath);

                        if(!empty($data['current_vendor_image'])) {
                            $image_path = 'admin/images/photos/'.$data['current_vendor_image'];
    
                            if(file_exists($image_path)) {
                                unlink($image_path);
                            }
                        }
                    }
                }else if(!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                }else {
                    $imageName = "";
                }
    
                // Update in Admins Table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);
                
                // Update in Vendors Table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 
                'address'=>$data['vendor_address'], 'city'=>$data['vendor_city'], 'state'=>$data['vendor_state'], 'country'=>$data['vendor_country'],
                'pincode'=>$data['vendor_pin']]);
                return redirect()->back()->with('success_message','Vendor Details has been updated!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if($slug == "business") {
            Session::put('page','business');
            if($request->isMethod('post')) {
                $data = $request->all();

                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'shop_address' => 'required',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_pin' => 'required',
                    'business_license' => 'required',
                    'tax_id' => 'required',
                    'address_proof' => 'required'
                ];

                $messages = [
                    'shop_name.required' => 'Name is required',
                    'shop_mobile.required' => 'Mobile Number is required',
                    'shop_address.required' => 'Address is required',
                    'shop_city.required' => 'City is required',
                    'shop_state.required' => 'State is required',
                    'shop_country.required' => 'Country is required',
                    'shop_pin.required' => 'Pin Code is required',
                    'business_license.required' => 'Business License Number is required',
                    'tax_id.required' => 'Tax Identification Number is required',
                    'address_proof.required' => 'Address Proof is required',
                    'shop_name.regex' => 'Please enter valid name',
                    'shop_city.regex' => 'Please enter valid City',
                    'shop_state.regex' => 'Please enter valid State',
                    'shop_country.regex' => 'Please enter valid Country'
                ];

                $this->validate($request, $rules, $messages);
                        
                // Update Admin Photo
                if($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if($image_tmp->isValid()) {
                        $random = Str::random(30);
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = $random.'.'.$extension;
                        $imagePath = 'admin/images/proofs/'.$imageName;
                        // Upload the Image
                        Image::make($image_tmp)->save($imagePath);

                        if(!empty($data['current_address_image'])) {
                            $image_path = 'admin/images/proofs/'.$data['current_address_image'];
    
                            if(file_exists($image_path)) {
                                unlink($image_path);
                            }
                        }
                    }
                }else if(!empty($data['current_address_image'])) {
                    $imageName = $data['current_address_image'];
                }else {
                    $imageName = "";
                }
                
                $shopUrl = strtolower(str_replace([' ','&','/'], '-', $data['shop_name']));
                
                $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
                if($vendorCount>0) {
                    // Update in Vendors_Business_Detail Table
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=>$data['shop_name'], 'shop_mobile'=>$data['shop_mobile'], 
                    'shop_website'=>$data['shop_website'],'shop_url'=>$shopUrl,'shop_address'=>$data['shop_address'], 'shop_city'=>$data['shop_city'], 'shop_state'=>$data['shop_state'], 'shop_country'=>$data['shop_country'],
                    'shop_pincode'=>$data['shop_pin'],'business_license_number'=>$data['business_license'],
                    'tax_id'=>$data['tax_id'],'address_proof'=>$data['address_proof'],'address_proof_image'=>$imageName]);
                    return redirect()->back()->with('success_message','Business Details has been updated!');
                }else {
                    VendorsBusinessDetail::insert(['id' => Auth::guard('admin')->user()->vendor_id, 'vendor_id' => Auth::guard('admin')->user()->vendor_id, 'shop_email' => $data['shop_email'], 'shop_name'=>$data['shop_name'], 'shop_mobile'=>$data['shop_mobile'], 
                    'shop_website'=>$data['shop_website'],'shop_url'=>$shopUrl,'shop_address'=>$data['shop_address'], 'shop_city'=>$data['shop_city'], 'shop_state'=>$data['shop_state'], 'shop_country'=>$data['shop_country'],
                    'shop_pincode'=>$data['shop_pin'],'business_license_number'=>$data['business_license'],
                    'tax_id'=>$data['tax_id'],'address_proof'=>$data['address_proof'],'address_proof_image'=>$imageName]);
                    return redirect()->back()->with('success_message','Business Details has been updated!');
                }
            }
            $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if($vendorCount>0) {
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            }else {
                $vendorDetails = array();
            }
            
        }else if($slug == "bank") {
            Session::put('page','bank');
            if($request->isMethod('post')) {
                $data = $request->all();

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_code' => 'required',
                    'bank_name' => 'required',
                    'account_number' => 'required',
                ];

                $messages = [
                    'account_holder_name.required' => 'Name is required',
                    'bank_code.required' => 'Mobile Number is required',
                    'bank_name.required' => 'Address is required',
                    'account_number.required' => 'City is required',
                    'account_holder_name.regex' => 'Please enter valid name',
                ];

                $this->validate($request, $rules, $messages);

                $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
                if($vendorCount>0) {
                // Update in Vendors_Bank_Detail Table
                    VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=>$data['account_holder_name'], 
                    'bank_code'=>$data['bank_code'], 'bank_name'=>$data['bank_name'], 'account_number'=>$data['account_number']]);
                    return redirect()->back()->with('success_message','Bank Information has been updated!');
                }else {
                    VendorsBankDetail::insert(['id' => Auth::guard('admin')->user()->vendor_id, 'vendor_id' => Auth::guard('admin')->user()->vendor_id, 'account_holder_name'=>$data['account_holder_name'], 
                    'bank_code'=>$data['bank_code'], 'bank_name'=>$data['bank_name'], 'account_number'=>$data['account_number']]);
                    return redirect()->back()->with('success_message','Bank Information has been updated!');
                }

            }

            $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if($vendorCount>0) {
                $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            }else {
                $vendorDetails = array();
            }
        }
        $countries = Country::where('status', 1)->get()->toArray();
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails', 'countries'));
    }

    // View Admin Management
    public function admins($type=null) {
        $admins = Admin::query();
        if(!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type)."s";
            Session::put('page','view_'.strtolower($title));
        }else {
            $title = "All Admins/Subadmins/Vendors";
            Session::put('page','view_all');
        }
        $admins = $admins->get()->toArray();
        return view('admin.admin-manage.admins')->with(compact('admins', 'title'));
    }

    // View Vendor Details in Admin Management
    public function viewVendorDetails($id) {
        Session::put('page','view_all');
        $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        return view('admin.admin-manage.view_vendor_details')->with(compact('vendorDetails'));
    }

    public function updateAdminStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }

            Admin::where('id', $data['admin_id'])->update(['status'=>$status]);

            $adminDetails = Admin::where('id', $data['admin_id'])->first()->toArray();
            if($adminDetails['type']=="vendor" && $status==1) {
                // Send Approval Email\
                $email = $adminDetails['email'];
                $messageData = [
                    'email' => $adminDetails['email'],
                    'name' => $adminDetails['name'],
                    'mobile' => $adminDetails['mobile'],
                ];
                Mail::send('front.emails.vendor_approved', $messageData, function($message)use($email) {
                    $message->to($email)->subject('myCommerce Vendor Account is Approved');
                });
            }
            return response()->json(['status'=>$status, 'admin_id'=>$data['admin_id']]);
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
