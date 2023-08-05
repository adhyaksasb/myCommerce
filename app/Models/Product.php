<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function admin() {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

    public function section() {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function parentCategory() {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id','category_name','url');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function attributes() {
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images() {
        return $this->hasMany('App\Models\ProductsImage');
    }

    public function vendor() {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id')->with('vendorsbusinessdetail');
    }
    
    public static function getDiscountPrice($product_id) {
        $productDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        $categoryDetails = json_decode(json_encode($categoryDetails), true);

        if($productDetails['product_discount']>0) {
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price']*$productDetails['product_discount']/100);
        }else if($categoryDetails['category_discount']>0) {
            //If Product discount is not added but category discount add from the admin panel
            $discounted_price = $productDetails['product_price'] - ($productDetails['product_price']*$categoryDetails['category_discount']/100);
        }else{
            $discounted_price = 0;       
        }
        return $discounted_price;
    }

    public static function getDiscountAttributePrice($product_id, $size) {
        $attributePrice= ProductsAttribute::where(['product_id'=>$product_id, 'size'=>$size])->first()->toArray();
        $productDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first();
        $productDetails = json_decode(json_encode($productDetails), true);
        $categoryDetails = Category::select('category_discount')->where('id', $productDetails['category_id'])->first();
        $categoryDetails = json_decode(json_encode($categoryDetails), true);

        $isProductAvailable = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size,'status'=>1])->count();

        if($productDetails['product_discount']>0) {
            $discounted_price = $attributePrice['price'] - ($attributePrice['price']*$productDetails['product_discount']/100);
            $savePrice = $attributePrice['price'] - $discounted_price;
            $discount = $productDetails['product_discount'];
        }else if($categoryDetails['category_discount']>0) {
            //If Product discount is not added but category discount add from the admin panel
            $discounted_price = $attributePrice['price'] - ($attributePrice['price']*$categoryDetails['category_discount']/100);
            $savePrice = $attributePrice['price'] - $discounted_price;
            $discount = $categoryDetails['category_discount'];
        }else{
            $discounted_price = $attributePrice['price'];
            $savePrice = 0;
            $discount = 0;       
        }
        $roundedFinal = round($discounted_price, 2);
        $roundedSave = round($savePrice, 2);
        $roundedDiscount = round($discount, 2);
        return array('product_price'=>$attributePrice['price'],'final_price'=>$roundedFinal,'save'=>$roundedSave, 'discount'=>$roundedDiscount, 'stock'=>$attributePrice['stock'], 'productAvailable'=>$isProductAvailable);
    }

    public static function isProductNew($product_id) {
        // Get Last 8 Products
        $productIds = Product::select('id')->where('status',1)->orderby('id','Desc')->limit(8)->pluck('id');
        $productIds = json_decode(json_encode($productIds), true);
        if(in_array($product_id,$productIds)) {
            $isProductNew = "Yes";
        }else {
            $isProductNew = "No";
        }
        return $isProductNew;
    }
}
