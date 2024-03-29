@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Checkout</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="checkout.html">Checkout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Checkout-Page -->
<div class="page-checkout u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- First-Accordion -->
                <div>
                    <div class="message-open u-s-m-b-24">
                        Returning customer?
                        <strong>
                            <a class="u-c-brand" data-toggle="collapse" href="#showlogin">Click here to login
                            </a>
                        </strong>
                    </div>
                    <div class="collapse u-s-m-b-24" id="showlogin">
                        <h6 class="collapse-h6">Welcome back! Sign in to your account.</h6>
                        <h6 class="collapse-h6">If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.</h6>
                        <form>
                            <div class="group-inline u-s-m-b-13">
                                <div class="group-1 u-s-p-r-16">
                                    <label for="user-name-email">Username or Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="user-name-email" class="text-field" placeholder="Username / Email">
                                </div>
                                <div class="group-2">
                                    <label for="password">Password
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="password" class="text-field" placeholder="Password">
                                </div>
                            </div>
                            <div class="u-s-m-b-13">
                                <button type="submit" class="button button-outline-secondary">Login</button>
                                <input type="checkbox" class="check-box" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">Remember me</label>
                            </div>
                            <div class="page-anchor">
                                <a href="#" class="u-c-brand">Lost your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- First-Accordion /- -->
                <!-- Second Accordion -->
                <div>
                    <div class="message-open u-s-m-b-24">
                        Have a coupon?
                        <strong>
                            <a class="u-c-brand" data-toggle="collapse" href="#showcoupon">Click here to enter your code</a>
                        </strong>
                    </div>
                    <div class="collapse u-s-m-b-24" id="showcoupon">
                        <h6 class="collapse-h6">
                            Enter your coupon code if you have one.
                        </h6>
                        <div class="coupon-field">
                            <label class="sr-only" for="coupon-code">Apply Coupon</label>
                            <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                            <button type="submit" class="button">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <!-- Second Accordion /- -->
                <form>
                    <div class="row">
                        <!-- Billing-&-Shipping-Details -->
                        <div class="col-lg-6">
                            <p style="color:red;" id="address-error"></p>
                            <p style="color:green;" id="address-success"></p>
                            @if(count($addresses)>0)
                                <h4 class="section-h4">Delivery Addresses</h4>
                                <div id="appendAddressList">
                                    @include('front.users.address_list')
                                </div>
                                <div class="separator">Or</div>
                                <button type="button" class="button button-primary" id="editAddress">Edit Address</button>&nbsp;&nbsp;
                                <button type="button" class="button button-primary" data-modal-target="#modal" id="newAddress">Add New Address</button>
                            @else
                                <h4 class="section-h4">Delivery Addresses</h4>
                                <p>There's no saved delivery addresses</p>
                                <h4 class="section-h4">Add New Delivery Address</h4>
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="first-name">First Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="first-name" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="last-name">Last Name
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="last-name" class="text-field">
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-country">Country
                                        <span class="astk">*</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-country">
                                            <option selected="selected" value="">Choose your country...</option>
                                            <option value="">United Kingdom (UK)</option>
                                            <option value="">United States (US)</option>
                                            <option value="">United Arab Emirates (UAE)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="street-address u-s-m-b-13">
                                    <label for="req-st-address">Street Address
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="req-st-address" class="text-field" placeholder="House name and street name">
                                    <label class="sr-only" for="opt-st-address"></label>
                                    <input type="text" id="opt-st-address" class="text-field" placeholder="Apartment, suite unit etc. (optional)">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="town-city">Town / City
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="town-city" class="text-field">
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="select-state">State / Country
                                        <span class="astk"> *</span>
                                    </label>
                                    <div class="select-box-wrapper">
                                        <select class="select-box" id="select-state">
                                            <option selected="selected" value="">Choose your state...</option>
                                            <option value="">Alabama</option>
                                            <option value="">Alaska</option>
                                            <option value="">Arizona</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="u-s-m-b-13">
                                    <label for="postcode">Postcode / Zip
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="postcode" class="text-field">
                                </div>
                                <div class="group-inline u-s-m-b-13">
                                    <div class="group-1 u-s-p-r-16">
                                        <label for="email">Email address
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="email" class="text-field">
                                    </div>
                                    <div class="group-2">
                                        <label for="phone">Phone
                                            <span class="astk">*</span>
                                        </label>
                                        <input type="text" id="phone" class="text-field">
                                    </div>
                                </div>
                                <div class="u-s-m-b-30">
                                    <input type="checkbox" class="check-box" id="create-account">
                                    <label class="label-text" for="create-account">Save Address</label>
                                </div>
                                <!-- Form-Fields /- -->
                            @endif
                            <div class="mt-15">
                                <label for="order-notes">Order Notes</label>
                                <textarea class="text-area" id="order-notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <!-- Billing-&-Shipping-Details /- -->
                        <!-- Checkout -->
                        <div class="col-lg-6">
                            <h4 class="section-h4">Your Order</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Product Name</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Black Rock Dress with High Jewelery Necklace</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Xiaomi Note 2 Black Color</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Dell Inspiron 15</h6>
                                                <span class="order-span-quantity">x 1</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">$100.00</h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Subtotal</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$220.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Shipping</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Tax</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$0.00</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Total</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">$220.00</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="cash-on-delivery">
                                    <label class="label-text" for="cash-on-delivery">Cash on Delivery</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="credit-card-stripe">
                                    <label class="label-text" for="credit-card-stripe">Credit Card (Stripe)</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="radio" class="radio-box" name="payment-method" id="paypal">
                                    <label class="label-text" for="paypal">Paypal</label>
                                </div>
                                <div class="u-s-m-b-13">
                                    <input type="checkbox" class="check-box" id="accept">
                                    <label class="label-text no-color" for="accept">I’ve read and accept the
                                        <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                    </label>
                                </div>
                                <button type="submit" class="button button-outline-secondary">Place Order</button>
                            </div>
                        </div>
                        <!-- Checkout /- -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Checkout-Page /- -->
<!-- Modal for Add/Edit Address -->
@include('front.users.modal_address')
<div id="overlay"></div>
<!-- Modal for Add/Edit Address -->
@endsection