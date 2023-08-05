<?php
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;

function totalCartItems() {
    if(Auth::check()) {
        $user_id = Auth::user()->id;
        $totalCartItems =  Cart::where('user_id', $user_id)->sum('quantity');
    }else {
        $session_id = Session::get('session_id');
        $totalCartItems = Cart::where('session_id', $session_id)->sum('quantity');
    }
    return $totalCartItems;
}

function totalCartPrice() {
    $total = 0;
    $test = array();
    if(Auth::check()) {
        $cartItems = Cart::with(['product'=>function($query) {
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_url','final_price');
        }])->where('user_id', Auth::user()->id)->orderby('id','desc')->get()->toArray();
        
        foreach($cartItems as $item) {
            $price = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            $subtotal = $price['final_price'] * $item['quantity'];
            $total += $subtotal;
        }
    }else {
        $cartItems = Cart::with(['product'=>function($query) {
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_url','final_price');
        }])->where('session_id', Session::get('session_id'))->orderby('id','desc')->get()->toArray();
        foreach($cartItems as $item) {
            $price = Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            $subtotal = $price['final_price'] * $item['quantity'];
            $total += $subtotal;
        }
    }
    // dd($test);

    return number_format((float)$total, 2, '.', '');
}

function getCartItems() {
    if(Auth::check()) {
        // If user Logged in
        $getCartItems = Cart::with(['product'=>function($query) {
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_url','final_price');
        }])->where('user_id', Auth::user()->id)->orderby('id','desc')->get()->toArray();
    }else {
        // If user not logged in
        $getCartItems = Cart::with(['product'=>function($query) {
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_url','final_price');
        }])->where('session_id', Session::get('session_id'))->orderby('id','desc')->get()->toArray();
    }
    return $getCartItems;
}