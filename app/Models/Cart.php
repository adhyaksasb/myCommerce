<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class Cart extends Model
{
    use HasFactory;

    public static function getCartItems() {
        if(Auth::check()) {
            // If user Logged in
            $getCartItems = Cart::with(['product'=>function($query) {
                $query->select('id','category_id','brand_id','vendor_id','product_name','product_code','product_color','product_image','product_url','final_price');
            }])->where('user_id', Auth::user()->id)->orderby('id','desc')->get()->toArray();
        }else {
            // If user not logged in
            $getCartItems = Cart::with(['product'=>function($query) {
                $query->select('id','category_id','brand_id','vendor_id','product_name','product_code','product_color','product_image','product_url','final_price');
            }])->where('session_id', Session::get('session_id'))->orderby('id','desc')->get()->toArray();
        }
        return $getCartItems;
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
