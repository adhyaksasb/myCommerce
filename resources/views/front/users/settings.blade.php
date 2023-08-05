@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account Settings</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{url('/user/settings')}}">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
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
        <div class="setting-tabs">
            <input type="radio" name="slider" checked id="details" />
            <input type="radio" name="slider" id="security" />
            <input type="radio" name="slider" id="address" />
            <input type="radio" name="slider" id="bank" />
            <input type="radio" name="slider" id="notification" />
            <nav>
              <label for="details" class="details"><i class="fas fa-user"></i><span class="tabs-title">Account Details</span></label>
              <label for="security" class="security"><i class="fas fa-user-shield"></i><span class="tabs-title">Account Security</span></label>
              <label for="address" class="address"><i class="fas fa-map-marked-alt"></i><span class="tabs-title">Address List</span></label>
              <label for="bank" class="bank"><i class="fas fa-money-check"></i><span class="tabs-title">Bank Account</span></label>
              <label for="notification" class="notification"><i class="fas fa-bell"></i><span class="tabs-title">Notification</span></label>
              <div class="slider"></div>
            </nav>
            <section>
              <div class="content content-1">
                <div class="row">
                    <!-- User Account -->
                    <div class="col-lg-6">
                        <div class="login-wrapper">
                            <h2 class="account-h2 u-s-m-b-20">User Account Details</h2>
                            <h6 class="account-h6 u-s-m-b-30">@if(Auth::user()->email_verified == "Yes")Change your account details. @else Your email is not verified yet, please check your email to verify. If you didn't receive the email confirmation, <a id="resend-code" data="{{ Auth::user()->email }}" data2="{{ Auth::user()->name }}">Resend Code</a>. @endif</h6>
                            <p style="color:red;" id="account-error"></p>
                            <p style="color:green;" id="account-success"></p>
                            <p style="color:green;" id="resend-email-success"></p>
                            <form id="accountForm" action="javascript:;" method="post">@csrf
                                <div class="u-s-m-b-30">
                                    <label for="user-email">Email @if(Auth::user()->email_verified == "Yes") <span class="verified-tag">Verified</span> @else <span class="not-verified-tag">Not Verified</span> @endif
                                    </label>
                                    <input type="email" class="text-field" value="{{ Auth::user()->email }}" disabled style="background-color:#f9f9f9">
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-name">Name
                                    </label>
                                    <input type="text" id="user-name" name="name" class="text-field" value="{{ Auth::user()->name }}" placeholder="Enter Your Name" >
                                    <p style="color:red;" id="account-name"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-mobile">Mobile
                                    </label>
                                    <input type="number" id="user-mobile" name="mobile" class="text-field" value="{{ Auth::user()->mobile }}" placeholder="Enter Your Mobile">
                                    <p style="color:red;" id="account-mobile"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-address">Address
                                    </label>
                                    <input type="text" id="user-address" name="address" class="text-field" value="{{ Auth::user()->address }}" placeholder="Enter Your Address">
                                    <p style="color:red;" id="account-address"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-country">Country
                                    </label>
                                    <select name="country" id="user-country" class="selectCountries">
                                        <option value="" selected disabled>-- Select Country --</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country['country_name'] }}" @if(!empty(Auth::user()->country) && Auth::user()->country == $country['country_name']) selected @endif>{{ $country['country_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <p style="color:red;" id="account-country"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-state">State
                                    </label>
                                    <input type="text" id="user-state" name="state" class="text-field" value="{{ Auth::user()->state }}" placeholder="Enter Your State">
                                    <p style="color:red;" id="account-state"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-city">City
                                    </label>
                                    <input type="text" id="user-city" name="city" class="text-field" value="{{ Auth::user()->city }}" placeholder="Enter Your City">
                                    <p style="color:red;" id="account-city"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-pincode">PIN Code
                                    </label>
                                    <input type="number" id="user-pincode" name="pincode" class="text-field" value="{{ Auth::user()->pincode }}" placeholder="Enter Your PIN Code">
                                    <p style="color:red;" id="account-pincode"></p>
                                </div>
                                <div class="m-b-45">
                                    <button class="button button-outline-secondary w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- User Account /- -->
                    <!-- User Password -->
                    <div class="col-lg-6">
                        <div class="reg-wrapper">
                            <h2 class="account-h2 u-s-m-b-20">Change Password</h2>
                            <h6 class="account-h6 u-s-m-b-30">Change your password frequently to increase security of your account.</h6>
                            <p style="color:red;" id="password-error"></p>
                            <p style="color:green;" id="password-success"></p>
                            <form id="passwordForm" action="javascript:;" method="post">@csrf
                                <div class="u-s-m-b-30">
                                    <label for="user-current-password">Current Password
                                    <span class="astk">*</span>
                                    </label>
                                    <input type="password" id="user-current-password" name="current_password" class="text-field" placeholder="Enter Your Current Password">
                                    <p style="color:red;" id="password-current_password"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-new-password">New Password
                                    <span class="astk">*</span>
                                    </label>
                                    <input type="password" id="user-new-password" name="new_password" class="text-field" placeholder="Enter Your New Password">
                                    <p style="color:red;" id="password-new_password"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-confirm-password">Confirm Password
                                    <span class="astk">*</span>
                                    </label>
                                    <input type="password" id="user-confirm-password" name="confirm_password" class="text-field" placeholder="Confirm Your Password">
                                    <p style="color:red;" id="password-confirm_password"></p>
                                </div>
                                <div class="u-s-m-b-45">
                                    <button class="button button-primary w-100">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- User Password /- -->
                </div>
              </div>
              <div class="content content-2">
                <div class="title">This is a Blog content</div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit amet.
                  Possimus doloris nesciunt mollitia culpa sint itaque, vitae
                  praesentium assumenda suscipit fugit doloremque adipisci doloribus,
                  sequi facere itaque cumque accusamus, quam molestias sed provident
                  quibusdam nam deleniti. Autem eaque aut impedit eo nobis quia, eos
                  sequi tempore! Facere ex repellendus, laboriosam perferendise. Enim
                quis illo harum, exercitationem nam totam fugit omnis natus quam
                  totam, repudiandae dolor laborum! Commodi?
                </p>
              </div>
              <div class="content content-3">
                    <!-- Address List -->
                    <div class="address-wrapper">
                        <p style="color:red;" id="address-error"></p>
                        <p style="color:green;" id="address-success"></p>
                        <div class="u-s-m-b-45 right">
                            <button class="button dangerButton br-10" id="deleteAddress">Delete Address</button>&nbsp;&nbsp;
                            <button class="button button-primary br-10" id="editAddress">Edit Address</button>&nbsp;&nbsp;
                            <button class="button button-primary br-10" data-modal-target="#modal" id="newAddress">Add New Address</button>
                        </div>
                        <h2>Address List</h2>
                        <div id="appendAddressList">
                            @include('front.users.address_list')
                        </div>
                    </div>
                    <!-- Address List /- -->
              </div>
              <div class="content content-4">
                <div class="title">This is a Help content</div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim
                  reprehenderit null itaq, odio repellat asperiores vel voluptatem
                  magnam praesentium, eveniet iure ab facere officiis. Quod sequi vel,
                  rem quam provident soluta nihil, eos. Illo oditu omnis cumque
                  praesentium voluptate maxime voluptatibus facilis nulla ipsam quidem
                  mollitia! Veniam, fuga, possimus. Commodi, fugiat aut ut quorioms
                  stu necessitatibus, cumque laborum rem provident tenetur.
                </p>
              </div>
              <div class="content content-5">
                <div class="title">This is a About content</div>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Consequatur officia sequi aliquam. Voluptatem distinctio nemo culpa
                  veritatis nostrum fugit rem adipisci ea ipsam, non veniam ut
                  aspernatur aperiam assumenda quis esse soluta vitae, placeat quasi.
                  Iste dolorum asperiores hic impedit nesciunt atqu, officia magnam
                  commodi iusto aliquid eaque, libero.
                </p>
              </div>
            </section>
            <!-- Modal for Add/Edit Address -->
            @include('front.users.modal_address')
            <div id="overlay"></div>
            <!-- Modal for Add/Edit Address -->
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection