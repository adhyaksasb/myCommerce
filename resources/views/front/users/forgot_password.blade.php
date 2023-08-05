@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Lost Password</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="lost-password.html">Lost Password</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Lost-password-Page -->
<div class="page-lost-password u-s-p-t-80">
    <div class="container">
        <div class="page-lostpassword">
            <h2 class="account-h2 u-s-m-b-20">Forgot Password ?</h2>
            <h6 class="account-h6 u-s-m-b-30">Enter your email below and we will send you a new password.</h6>
            <p style="color:red;" id="forgot-error"></p>
            <p style="color:green;" id="forgot-success"></p>
            <form id="forgotForm" action="javascript:;" method="post">@csrf
                <div class="w-50">
                    <div class="u-s-m-b-13">
                        <label for="user-name-email">Email
                            <span class="astk">*</span>
                        </label>
                        <input type="email" name="email" id="users-email" class="text-field" placeholder="Email">
                        <p style="color:red;" id="forgot-email"></p>
                    </div>
                    <div class="u-s-m-b-13">
                        <button class="button button-outline-secondary">Get New Password</button>
                    </div>
                </div>
                <div class="page-anchor">
                    <a href="{{ url('user/login-register')}}">
                        <i class="fas fa-long-arrow-alt-left u-s-m-r-9"></i>Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Lost-Password-Page /- -->
@endsection