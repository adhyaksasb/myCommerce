<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilter extends Model
{
    use HasFactory;

    public function filter_values() {
        return $this->hasMany('App\Models\ProductsFiltersValue', 'filter_id');
    }

    public static function productFilters() {
        $productFilters = ProductsFilter::with('filter_values')->where('status',1)->get()->toArray();
        return $productFilters;
    }

    // Check if Filter Available
    public static function filterAvailable($filter_id,$category_id) {
        $filterAvailable = ProductsFilter::select('category_ids')->where(['id'=>$filter_id, 'status'=>1])->first()->toArray();
        $catIdsArr = explode(",",$filterAvailable['category_ids']);
        if(in_array($category_id, $catIdsArr)) {
            $available = "Yes";
        } else {
            $available = "No";
        }
        return $available;
    }

    // Get Sizes based of category
    public static function getSizes($url) {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::whereIn('category_id', $categoryDetails['categoryIds'])->pluck('id')->toArray();
        $getProductSizes = ProductsAttribute::select('size')->whereIn('product_id', $getProductIds)->groupby('size')->pluck('size')->toArray();
        
        return $getProductSizes;
    }

    // Get Color based of category
    public static function getColors($url) {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::whereIn('category_id', $categoryDetails['categoryIds'])->pluck('id')->toArray();
        $getProductColors = Product::select('product_color')->whereIn('id', $getProductIds)->groupBy('product_color')->pluck('product_color')->toArray();

        return $getProductColors;
    }

    // Get Color based of category
    public static function getBrands($url) {
        $categoryDetails = Category::categoryDetails($url);
        $getProductIds = Product::whereIn('category_id', $categoryDetails['categoryIds'])->pluck('id')->toArray();
        $brandIds = Product::select('brand_id')->whereIn('id', $getProductIds)->groupBy('brand_id')->pluck('brand_id')->toArray();
        $brandDetails = Brand::select('id','name')->whereIn('id',$brandIds)->get()->toArray();
        return $brandDetails;
    }
}
