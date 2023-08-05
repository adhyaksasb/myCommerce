@extends('front.layout.layout')
@section('content')
<!-- Account-Page -->
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
                    <h2 class="account-h2 u-s-m-b-20">Vendor Login</h2>
                    <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                    <form action="{{ url('admin/login') }}" method="post">@csrf
                        <div class="u-s-m-b-30">
                            <label for="vendor-email">Email
                            <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="vendor-email" class="text-field" placeholder="Username / Email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="login-password">Password
                            <span class="astk">*</span>
                            </label>
                            <input type="password" name="password" id="vendor-password" class="text-field" placeholder="Password">
                        </div>
                        <div class="group-inline u-s-m-b-30">
                            <div class="group-1">
                                <input type="checkbox" class="check-box" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">Remember me</label>
                            </div>
                            <div class="group-2 text-right">
                                <div class="page-anchor">
                                    <a href="lost-password.html">
                                    <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
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
                    <h2 class="account-h2 u-s-m-b-20">Vendor Register</h2>
                    <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>
                    <form id="vendorForm" action="{{ url('vendor/register') }}" method="post">@csrf
                        <div class="u-s-m-b-30">
                            <label for="vendor_name">Name
                            <span class="astk">*</span>
                            </label>
                            <input type="text" id="vendor_name" name="name" class="text-field" placeholder="Enter Your Name"  >
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendor_mobile">Mobile
                            <span class="astk">*</span>
                            </label>
                            <input type="number" id="vendor_mobile" name="mobile" class="text-field" placeholder="Enter Your Mobile Number"  >
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendor_email">Email
                            <span class="astk">*</span>
                            </label>
                            <input type="email" id="vendor_email" name="email" class="text-field" placeholder="Enter Your Email"  >
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendor_password">Password
                            <span class="astk">*</span>
                            </label>
                            <input type="password" id="vendor_password" name="password" class="text-field" placeholder="Enter Your Password"  >
                        </div>
                        <div class="u-s-m-b-30">
                            <input type="checkbox" class="check-box" id="accept" name="accept" value="accept">
                            <label class="label-text no-color" for="accept">I’ve read and accept the
                            <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                            </label>
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
<!-- Account-Page /- -->
@endsection