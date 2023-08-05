<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Cart;
use App\Models\Country;
use App\Models\DeliveryAddress;
use Auth;
use Validator;
use DB;
use Session;
use Cache;
use Hash;

class UserController extends Controller
{
    public function loginRegister() {
        return view('front.users.login_register');
    }

    public function userRegister(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                'mobile' => 'required|max:14|min:7',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'accept' => 'required'],
                [
                    'accept.required' =>'Please accept our Terms & Conditions'
                ]
            );

            if($validator->passes()) {
                DB::beginTransaction();
                // Register the User
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                // Send Confirmation Register Email
                $email = $data['email'];
                $messageData = ['name'=>$data['name'],'email'=>$email,'code'=>base64_encode($data['email'])];
                Mail::send('front.emails.user_confirmation',$messageData,function($message)use($email){
                    $message->to($email)->subject('Verify your myCommerce User Account');
                });

                // Update Cart with user_id
                if(!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }

                DB::commit();
                
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                    $redirectTo = url('');
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }
                // return response()->json(['type'=>'success','message'=>"Account Created, please confirm your email address to login to your account"]);
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function userLogin(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6',]
            );

            if($validator->passes()) {
                $checkAuthenticator = User::select('authenticator')->where('email',$data['email'])->pluck('authenticator')->first();
                $checkStatus = User::select('status')->where('email',$data['email'])->pluck('status')->first();

                if($checkStatus == 0) {
                    return response()->json(['type'=>'inactive','message'=>'Your account is inactive. Please Contact mycommerce@admin.com']);
                }

                if($checkAuthenticator == 'No') {
                    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                        // Update Cart with user_id
                        if(!empty(Session::get('session_id'))) {
                            $user_id = Auth::user()->id;
                            $session_id = Session::get('session_id');
                            Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                        }
        
                        $redirectTo = url('/');
                        return response()->json(['type'=>'noAuthenticator','url'=>$redirectTo]);
                    }else {
                        return response()->json(['type'=>'incorrect','message'=>'Incorrect Email or Password!']);
                    }
                }else {
                    if(Auth::validate(['email'=>$data['email'],'password'=>$data['password']])) {
                        $otp = sprintf("%06d", mt_rand(1, 999999));
                        Cache::forget('otp');
                        Cache::put('otp', $otp, now()->addMinutes(3));
                        $title = "Login Verify";
                        $subtitle = "Login";
                        $email = $data['email'];
                        $password = $data['password'];
                        $messageData = ['email'=>$email,'otp'=>$otp];
                        Mail::send('front.emails.otp_confirmation',$messageData,function($message)use($email){
                            $message->to($email)->subject('Verify Login to myCommerce');
                        });
                        return response()->json(['type'=>'success','view'=>(String)View::make('front.otp.verify_otp')->with(compact('email','password','title','subtitle'))]);
                    }else {
                        return response()->json(['type'=>'incorrect','message'=>'Incorrect Email or Password!']);
                    }
                }
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function userLoginOTP(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $otp = Cache::get('otp');
            if($otp == $data['otp']) {
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                    if(Auth::user()->status==0) {
                        Auth::logout();
                        return response()->json(['type'=>'inactive','message'=>'Your account is inactive. Please Contact mycommerce@admin.com']);
                    }
    
                    // Update Cart with user_id
                    if(!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }
    
                    $redirectTo = url('');
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }
            } else {
                return response()->json(['type'=>'error','message'=>'Incorrect OTP or OTP Expired']);
            }
        }
    }

    public function forgotPassword(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email'],
                [
                    'email.exists' => 'Email does not exist!'
                ]
            );

            if($validator->passes()) {
                // Generate New Password & Input to User Database
                $new_password = Str::random(15);
                User::where('email',$data['email'])->update(['password'=>bcrypt($new_password)]);
                
                // Get User Details
                $userDetails = User::where('email', $data['email'])->first()->toArray();

                
                $email = $data['email'];
                $messageData = ['name'=>$userDetails['name'],'email'=>$email,'password'=>$new_password];
                // Send Email to User
                Mail::send('front.emails.user_forgot_password',$messageData,function($message)use($email){
                    $message->to($email)->subject('Here is Your New Password - myCommerce');
                });

                // Show Success Message
                return response()->json(['type'=>'success','message'=>"We've sent you an email for your new password, please check your email"]);
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
        return view('front.users.forgot_password');
    }

    public function confirmUser($email) {
        // Decode User Email
        $email = base64_decode($email);

        // Check User Email Exists
        $userCount = User::where('email', $email)->count();
        if($userCount>0) {
            // User Email is already activated or not
            $userDetails = User::where('email',$email)->first();
            if($userDetails->email_verified == "Yes") {
                $message = "Your User Account is already activated. You can login with your registered account.";
                return redirect('user/login-register')->with('error_message', $message);
            }else {
                // Update email_veried to Yes in User tables
                User::where('email', $email)->update(['email_verified'=>'Yes']);

                // Send Register Email
                $messageData = [
                    'email' => $email,
                    'name' => $userDetails->name,
                    'mobile' => $userDetails->mobile,
                ];

                Mail::send('front.emails.user_confirmed', $messageData, function($message)use($email) {
                    $message->to($email)->subject('myCommerce User Account is Verified');
                });

                // Redirect to User Login / Register Page with Success Message
                $message = "Your User Email account is activated.";
                return redirect('')->with('success_message', $message);
            }
        }else {
            abort(404);
        }
    }

    public function resendEmail(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            
            // Send Confirmation Register Email
            $email = $data['email'];
            $messageData = ['name'=>$data['name'],'email'=>$email,'code'=>base64_encode($data['email'])];
            Mail::send('front.emails.user_confirmation',$messageData,function($message)use($email){
                $message->to($email)->subject('Verify your myCommerce User Account');
            });

            // Show Success Message
            return response()->json(['type'=>'success','message'=>"We've sent you a new confirmation email, please check your email"]);
        }
    }

    public function userSettings(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                'mobile' => 'required|max:14|min:3',
                'address' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'pincode' => 'required|max:6',]
            );
            

            if($validator->passes()) {
                User::where('id', Auth::user()->id)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'address'=>$data['address'],
                'city'=>$data['city'],'state'=>$data['state'],'country'=>$data['country'],'pincode'=>$data['pincode']]);

                // Show Success Message
                return response()->json(['type'=>'success','message'=>"Your User Details successfully updated!"]);
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
        $addresses = DeliveryAddress::deliveryAddresses();
        $countries = Country::where('status', 1)->get()->toArray();
        return view('front.users.settings', compact('countries', 'addresses'));
    }

    public function userUpdatePassword(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            // "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:new_password',]
            );

            if($validator->passes()) {
                // Check if Currect Password is Correct
                if(Hash::check($data['current_password'],Auth::user()->password)) {
                    User::where('id', Auth::user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return response()->json(['type'=>'success','message'=>"Your password successfully updated!"]);
                }else {
                    return response()->json(['type'=>'incorrect','message'=>'Your current password is incorrect!']);
                }
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function getAddress(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $address = DeliveryAddress::where('id',$data['addressId'])->first()->toArray();
            return response()->json($address);
        }
    }

    public function addAddress(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
                'mobile' => 'required|max:14|min:3',
                'address' => 'required|string|max:100',
                'country' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'pincode' => 'required|max:6',]
            );

            if($validator->passes()) {
                if($data['id']>0) {
                    DeliveryAddress::where('id', $data['id'])->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'address'=>$data['address'],
                    'city'=>$data['city'],'state'=>$data['state'],'country'=>$data['country'],'pincode'=>$data['pincode']]);
                    $addresses = DeliveryAddress::deliveryAddresses();
                    // Show Success Message
                    return response()->json(['type'=>'success','message'=>"Delivery address has been successfully updated!",'view'=>(String)View::make('front.users.address_list', compact('addresses'))]);
                }else {
                    $addresses = DeliveryAddress::deliveryAddresses();
                    $totalAddresses = count($addresses);
                    // Check if total address is 5 or more
                    if($totalAddresses > 4) {
                        return response()->json(['type'=>'maxError','message'=>"You can only have maximum 5 addresses!"]);
                    }else {
                        $address = new DeliveryAddress;
                        $address->user_id = Auth::user()->id;
                        $address->name = $data['name'];
                        $address->mobile = $data['mobile'];
                        $address->address = $data['address'];
                        $address->country = $data['country'];
                        $address->state = $data['state'];
                        $address->city = $data['city'];
                        $address->pincode = $data['pincode'];
                        $address->status = 1;
                        $address->save();
                        $addresses = DeliveryAddress::deliveryAddresses();
                        // Show Success Message
                        return response()->json(['type'=>'success','message'=>"New delivery address has been successfully added!",'view'=>(String)View::make('front.users.address_list', compact('addresses'))]);
                    }
                }
            }else {
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function deleteAddress(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            DeliveryAddress::where('id', $data['addressId'])->delete();
            $addresses = DeliveryAddress::deliveryAddresses();
            return response()->json(['type'=>'success','message'=>"Delivery Address has been successfully deleted!",'view'=>(String)View::make('front.users.address_list', compact('addresses'))]);
        }
    }

    public function userLogout() {
        Auth::logout();
        session()->flush();

        return redirect('/');
    }
}
