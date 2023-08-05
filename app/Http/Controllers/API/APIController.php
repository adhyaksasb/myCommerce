<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Cookie;

class APIController extends Controller
{
    public function registerUser(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'mobile' => 'required|max:14|min:7',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'accept' => 'required'
            ];
            $customMessages = [
                "name.required" => "Name is required",
                "mobile.required" => "Mobile number is required",
                "email.required" => "Email is required",
                "email.email" => "Please enter a valid email",
                "email.unique" => "Email already exists",
                "password.required" => "Password is required",
                "accept.required" => "Please accept our Terms & Conditions"
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User;
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            $token = $user->createToken('reactToken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response()->json($response, 201);
        }
    }

    public function loginUser(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();

            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
                ];
            $customMessages = [
                "email.required" => "Email is required!",
                "email.exists" => "User not found!",
                "password.required" => "Password is required!",
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Check if user is exist
            $userCount = User::where('email',$data['email'])->count();

            if($userCount>0) {
                // Fetch User Details
                $user = User::where('email',$data['email'])->first();
                // Verify the password
                if(password_verify($data['password'],$user->password)) {
                    $token = $user->createToken('user_session')->plainTextToken;
                    $cookie = Cookie('jwt', $token, 60*24, null, null, false, false);
                    return response()->json(['status'=>true, 'message'=>'User login successfully!', 'token'=> $token], 201)->withCookie($cookie);
                }else {
                    return response()->json(['status'=>false, 'message'=>'Password is incorrect!'], 422);
                }
            } else {
                return response()->json(['status'=>false, 'error'=>'User not found!'], 422);
            }  
        }
    }

    public function logoutUser(Request $request) {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget('jwt');

        return response()->json(["status"=>true,"message"=>"Logged Out"], 201)->withCookie($cookie);
    }
}
