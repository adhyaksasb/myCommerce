@extends('front.layout.layout')
@section('content')
<!-- Account-Page -->
<div id="appendOTP">
    <div class="page-account u-s-p-t-60">
        <div class="container">
            @if(Session::has('error_message'))
            <br><br>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(Session::has('success_message'))
            <br><br>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">User Login</h2>
                        <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                        <p style="color:red;" id="login-error"></p>
                        <form id="loginForm" action="javascript:;" method="post">@csrf
                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                <span class="astk">*</span>
                                </label>
                                <input type="email" name="email" id="users-email" class="text-field" placeholder="Email">
                                <p style="color:red;" id="login-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="login-password">Password
                                <span class="astk">*</span>
                                </label>
                                <input type="password" name="password" id="users-password" class="text-field" placeholder="Password">
                                <p style="color:red;" id="login-password"></p>
                            </div>
                            <div class="group-inline u-s-m-b-30">
                                <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token">
                                    <label class="label-text" for="remember-me-token">Remember me</label>
                                </div>
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="{{ url('user/forgot-password')}}">
                                        <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Forgot password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20">User Register</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>
                        <form id="registerForm" action="javascript:;" method="post">@csrf
                            <div class="u-s-m-b-30">
                                <label for="user-name">Name
                                <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" name="name" class="text-field" placeholder="Enter Your Name" >
                                <p style="color:red;" id="register-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-mobile">Mobile
                                <span class="astk">*</span>
                                </label>
                                <input type="number" id="user-mobile" name="mobile" class="text-field" placeholder="Enter Your Mobile Number">
                                <p style="color:red;" id="register-mobile"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-email" name="email" class="text-field" placeholder="Enter Your Email">
                                <p style="color:red;" id="register-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="user-password">Password
                                <span class="astk">*</span>
                                </label>
                                <input type="password" id="user-password" name="password" class="text-field" placeholder="Enter Your Password">
                                <p style="color:red;" id="register-password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="accept" value="accept">
                                <label class="label-text no-color" for="accept">I’ve read and accept the
                                <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                </label>
                                <p style="color:red;" id="register-accept"></p>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection