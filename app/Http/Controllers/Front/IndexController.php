<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class IndexController extends Controller
{
    public function index() {
        $sliderBanners = Banner::where('type','slider')->where('status',1)->get()->toArray();
        $fixedBanners = Banner::where('type','fixed')->where('status',1)->get()->toArray();
        $newProducts = Product::orderBy('id','Desc')->with('brand')->where('status',1)->limit(8)->get()->toArray();
        $bestSellers = Product::with('brand')->where(['status'=>1,'is_bestseller'=>'Yes'])->inRandomOrder()->limit(8)->get()->toArray();
        $discountedProducts = Product::with('brand')->where('product_discount','>',0)->where('status',1)->inRandomOrder()->limit(8)->get()->toArray();
        $featuredProducts = Product::with('brand')->where(['status'=>1,'is_featured'=>'Yes'])->inRandomOrder()->limit(8)->get()->toArray();
        return view('front.index.index')->with(compact('sliderBanners','fixedBanners', 'newProducts','bestSellers','discountedProducts','featuredProducts'));
    }

    public function directory() {
        // Get Sections with Categories and Sub-Categories
        $categories = Section::with('categories')->get()->toArray();
        return view('front.index.directory')->with(compact('categories'));
    }
}
