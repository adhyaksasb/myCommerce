<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Section;
use App\Models\Product;
use App\Models\ProductsFilter;
use App\Models\ProductsAttribute;
use App\Models\VendorsBusinessDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Country;
use Session;
use DB;
use Auth;

class ProductController extends Controller
{
    public function listing(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $_GET['sort'] = $data['sort'];
            $url = $data['url'];
            $sectionCount = Section::where(['url'=>$url,'status'=>1])->count();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
    
            if($categoryCount>0) {
                // Get Category Details
                $productDetails = Category::categoryDetails($url);
                $productListing = Product::with('category','section','brand')->whereIn('category_id', $productDetails['categoryIds'])->where('status',1);
                
                // Checking for Dynamic Filters
                $productFilters = ProductsFilter::productFilters();
                foreach($productFilters as $filter) {
                    // If filter is selected
                    if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                        $productListing->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }

                // Checking for Sort
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if($_GET['sort']=="product_latest") {
                        $productListing->orderby('products.id','Desc');
                    }else if($_GET['sort']=="lowest_price") {
                         $productListing->orderby('products.final_price','Asc');
                    }else if($_GET['sort']=="highest_price") {
                        $productListing->orderby('products.final_price','Desc');
                   }else if($_GET['sort']=="name_a_z") {
                         $productListing->orderby('products.product_name','Asc');
                    }else if($_GET['sort']=="name_z_a") {
                        $productListing->orderby('products.product_name','Desc');
                   }
                }

                // Checking for Size Filter
                if(isset($data['size']) && !empty($data['size'])) {
                    $productIds = ProductsAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray();
                    $productListing->whereIn('products.id', $productIds);
                }

                // Checking for Color Filter
                if(isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                    $productListing->whereIn('products.id', $productIds);
                }
                
                // Checking for Brand Filter
                if(isset($data['brand']) && !empty($data['brand'])) {
                    $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                    $productListing->whereIn('products.id', $productIds);
                }

                // Checking for Price Filter
                if(isset($data['min']) && isset($data['max']) && !empty($data['max'])) {
                    $productIds = Product::select('id')->whereBetween('final_price', [$data['min'],$data['max']])->pluck('id')->toArray();
                    $productListing->whereIn('products.id', $productIds);
                }

                $productListing = $productListing->paginate(9);
                return view('front.products.ajax_products_listing')->with(compact('productDetails','productListing', 'url'));
            }else if($sectionCount>0) {
                $productDetails = Section::sectionDetails($url);
                $productListing = Product::with('category','section','brand')->whereIn('category_id', $productDetails['categoryIds'])->where('status',1);
                
                // Checking for Sort
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if($_GET['sort']=="product_latest") {
                        $productListing->orderby('products.id','Desc');
                    }else if($_GET['sort']=="lowest_price") {
                         $productListing->orderby('products.final_price','Asc');
                    }else if($_GET['sort']=="highest_price") {
                        $productListing->orderby('products.final_price','Desc');
                   }else if($_GET['sort']=="name_a_z") {
                         $productListing->orderby('products.product_name','Asc');
                    }else if($_GET['sort']=="name_z_a") {
                        $productListing->orderby('products.product_name','Desc');
                   }
                }

                // Checking for Size
                if(isset($data['size']) && !empty($data['size'])) {
                    if($_GET['sort']=="product_latest") {
                        $productListing->orderby('products.id','Desc');
                    }else if($_GET['sort']=="lowest_price") {
                         $productListing->orderby('products.final_price','Asc');
                    }else if($_GET['sort']=="highest_price") {
                        $productListing->orderby('products.final_price','Desc');
                   }else if($_GET['sort']=="name_a_z") {
                         $productListing->orderby('products.product_name','Asc');
                    }else if($_GET['sort']=="name_z_a") {
                        $productListing->orderby('products.product_name','Desc');
                   }
                }

                $productListing = $productListing->paginate(9);
                return view('front.products.ajax_products_listing')->with(compact('productDetails', 'productListing', 'url'));
            }else {
                abort(404);
            }
        }else {
            $rawUrl = Route::getFacadeRoot()->current()->uri();
            $url = substr($rawUrl,2);
            $sectionCount = Section::where(['url'=>$url,'status'=>1])->count();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
    
            if($categoryCount>0) {
                // Get Category Details
                $productDetails = Category::categoryDetails($url);
                $productListing = Product::with('category','section','brand')->whereIn('category_id', $productDetails['categoryIds'])->where('status',1);
    
                // Checking for Sort
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if($_GET['sort']=="product_latest") {
                        $productListing->orderby('products.id','Desc');
                    }else if($_GET['sort']=="lowest_price") {
                         $productListing->orderby('products.final_price','Asc');
                    }else if($_GET['sort']=="highest_price") {
                        $productListing->orderby('products.final_price','Desc');
                   }else if($_GET['sort']=="name_a_z") {
                         $productListing->orderby('products.product_name','Asc');
                    }else if($_GET['sort']=="name_z_a") {
                        $productListing->orderby('products.product_name','Desc');
                   }
                }
    
                $productListing = $productListing->paginate(9);
                return view('front.products.listing')->with(compact('productDetails','productListing', 'url'));
            }else if($sectionCount>0) {
                $productDetails = Section::sectionDetails($url);
                $productListing = Product::with('category','section','brand')->whereIn('category_id', $productDetails['categoryIds'])->where('status',1);
                
                // Checking for Sort
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if($_GET['sort']=="product_latest") {
                        $productListing->orderby('products.id','Desc');
                    }else if($_GET['sort']=="lowest_price") {
                         $productListing->orderby('products.final_price','Asc');
                    }else if($_GET['sort']=="highest_price") {
                        $productListing->orderby('products.final_price','Desc');
                   }else if($_GET['sort']=="name_a_z") {
                         $productListing->orderby('products.product_name','Asc');
                    }else if($_GET['sort']=="name_z_a") {
                        $productListing->orderby('products.product_name','Desc');
                   }
                }
    
                $productListing = $productListing->paginate(9);
                return view('front.products.listing')->with(compact('productDetails', 'productListing', 'url'));
            }else {
                abort(404);
            }
        }
    }

    public function detail($url, $id) {
        $checkProduct = Product::where(['product_url'=>$url,'id'=>$id,'status'=>1])->count();
        if($checkProduct>0) {
            $productDetails = Product::with(['section','category','brand','admin','vendor','attributes'=>function($query){
                $query->where('status', 1);
            },'images'])->find($id)->toArray();
            $parentCategory = Category::select('category_name')->where('id', $productDetails['category']['parent_id'])->value('category_name');
            $parentUrl = Category::select('url')->where('id', $productDetails['category']['parent_id'])->value('url');
            $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');

            // Get Group Products (Product Variants)
            $groupProducts = array();
            if(!empty($productDetails['group_code'])) {
                $groupProducts = Product::select('id','product_image','product_url')->where('id','!=',$id)->where(['vendor_id'=>$productDetails['vendor_id'],'group_code'=>$productDetails['group_code'],'status'=>1])->get()->toArray();
            }

            // Get Similar Products
            $similarProducts = Product::with('brand', 'category')->where('category_id', $productDetails['category_id'])->where('id','!=',$id)->limit(12)->inRandomOrder()->get()->toArray();

            // Set Session for Recently Viewed Products
            if(empty(Session::get('session_id'))) {
                $session_id = Str::random(15);
            }else {
                $session_id = Session::get('session_id');
            }

            Session::put('session_id', $session_id);

            // Insert Product in Recently Viewed Table if not already exists.
            $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id'=>$id,'session_id'=>$session_id])->count();
            if($countRecentlyViewedProducts==0) {
                $maxOrder = DB::table('recently_viewed_products')->where('session_id',$session_id)->max('order_priority');
                $maxOrder++;
                DB::table('recently_viewed_products')->insert(['product_id'=>$id, 'session_id'=>$session_id,'order_priority'=>$maxOrder]);
            }else {
                $maxOrder = DB::table('recently_viewed_products')->where('session_id',$session_id)->max('order_priority');
                $maxOrder++;
                DB::table('recently_viewed_products')->where(['product_id'=>$id,'session_id'=>$session_id])->update(['order_priority'=> $maxOrder]);
            }

            // Get Recently Viewed Products if count > 1
            $countRecentlyViewed = DB::table('recently_viewed_products')->where(['session_id'=>$session_id])->count();
            if($countRecentlyViewed>1) {
                // Get Recently Viewed Products Ids
                $recentProductIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id','!=',$id)->where('session_id',$session_id)->orderBy('order_priority', 'DESC')->get()->take(12)->pluck('product_id')->toArray();
                $recentIds = implode(',', $recentProductIds);

                // Get Recently Viewed Products
                $recentProducts = Product::with('brand', 'category')->whereIn('id',$recentProductIds)->orderByRaw(DB::raw("FIELD(id, $recentIds)"))->get()->toArray();
                
            }else {
                $recentProducts = array();
            }

            
            return view('front.products.detail')->with(compact('productDetails', 'parentCategory', 'parentUrl', 'totalStock', 'similarProducts', 'recentProducts','groupProducts'));
        }else {
            abort(404);
        }
    }

    public function getProductPrice(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'],$data['size']);
            return $getDiscountAttributePrice;
        }
    }

    public function vendorListing($storeUrl, $vendorid) {
        $checkVendor = VendorsBusinessDetail::where(['shop_url'=>$storeUrl, 'vendor_id'=>$vendorid])->count();
        if($checkVendor>0) {
            $shopName = VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendorid)->first()->toArray();
            $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1);
            $vendorProducts = $vendorProducts->paginate(12);
            return view('front.products.vendor_listing')->with(compact('shopName', 'vendorProducts', 'storeUrl', 'vendorid'));
        }else {
            abort(404);
        }
    }

    public function adminListing() {
        $shopName['shop_name'] = "myCommerce Official";
        $storeUrl = "mycommerce";
        $vendorid = "0";
        $vendorProducts = Product::with('brand')->where('vendor_id', 0)->where('status', 1);
        $vendorProducts = $vendorProducts->paginate(12);
        return view('front.products.vendor_listing')->with(compact('shopName', 'vendorProducts', 'storeUrl', 'vendorid'));
    }

    public function cartAdd(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            // Check Product Stock is Available or Not (Server-side)
            $productStock = ProductsAttribute::getProductStock($data['product_id'], $data['size']);
            
            if($data['quantity']>$productStock) {
                return redirect()->back()->with('add_product_error', 'Buying quantity in your cart is more than stock available!');
            }

            $session_id = Session::get('session_id');
            if(empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // Check Product if already exists in the User Cart
            if(Auth::check()) {
                // User is Logged In
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['user_id'=>$user_id,'product_id'=>$data['product_id'],'size'=>$data['size']])->count();
            } else {
                // User is not Logged In
                $user_id = 0;
                $countProducts = Cart::where(['user_id'=>$user_id,'product_id'=>$data['product_id'],'size'=>$data['size']])->count();
            }

            $countCartItems = Cart::where(['session_id'=>$session_id,'product_id'=>$data['product_id'],'size'=>$data['size']])->count();
            
            if($countCartItems>0) {
                $quantity = Cart::select('quantity')->where(['session_id'=>$session_id,'product_id'=>$data['product_id'],'size'=>$data['size']])->value('quantity');
                $quantity = $quantity + $data['quantity'];
                if($quantity>$productStock) {
                    return redirect()->back()->with('add_product_error', 'Buying quantity is more than stock available!');
                }else {
                    Cart::where(['session_id'=>$session_id,'product_id'=>$data['product_id'],'size'=>$data['size']])->update(['quantity'=>$quantity]);
                    Session::forget('couponDiscount');
                    Session::forget('grandTotal');
                    Session::forget('couponCode');
                    return redirect()->back()->with('add_product_success','Product has been added to Cart! <br>
                    Coupon must be reapplied!<br><a href="/cart">Click Here to View Cart</a>');
                }
            }else {
                // Save Product in Carts Table
                $item = new Cart;
                $item->session_id = $session_id;
                $item->user_id = $user_id;
                $item->product_id = $data['product_id'];
                $item->size = $data['size'];
                $item->quantity = $data['quantity'];
                $item->save();
                Session::forget('couponDiscount');
                Session::forget('grandTotal');
                Session::forget('couponCode');
                return redirect()->back()->with('add_product_success','Product has been added to Cart!<br><a href="/cart">Click Here to View Cart</a>');
            }
        }
    }

    public function cart() {
        $cartItems = Cart::getCartItems();
        return view('front.products.cart', compact('cartItems'));
    }

    public function cartUpdate(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            $cartDetails = Cart::find($data['cartid']);

            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();

            // Check if product size is available
            $availableSize = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();
            if($availableSize==0) {
                $cartItems = Cart::getCartItems();
                return response()->json([
                    'status'=>false,'message'=>'Product is not available right now, please remove the item and choose another product.',
                    'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
            }

            // Check Product Stock
            if($data['qty']>$availableStock['stock']) {
                Cart::where('id', $data['cartid'])->update(['quantity'=>$availableStock['stock']]);
                $cartItems = Cart::getCartItems();
                $totalCartItems = totalCartItems();
                $totalCartPrice = totalCartPrice();
                return response()->json([
                    'status'=>false,'message'=>'Product stock is '.$availableStock['stock'].' left.',
                    'totalCartItems'=>$totalCartItems,
                    'totalCartPrice'=>$totalCartPrice,
                    'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
            }

            // Update the Quantity
            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['qty']]);
            $cartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $totalCartPrice = totalCartPrice();

            // If coupon applied
            if(Session::has('couponCode')) {
                $coupon = Coupon::where('coupon_code',Session::get('couponCode'))->first()->toArray();
                if($coupon['amount_type']=="Fixed") { // Fixed Coupon
                    $couponDiscount = $coupon['amount'];
                }else { // Percentage Coupon
                    $couponDiscount = $totalCartPrice * $coupon['amount'] / 100;
                }

                $grandTotal = $totalCartPrice - $couponDiscount;
                $couponDiscount = number_format($couponDiscount, 2);
                $grandTotal = number_format($grandTotal, 2);
    
                Session::put('couponDiscount', $couponDiscount);
                Session::put('grandTotal', $grandTotal);
            }

            return response()->json(['status'=>true,'totalCartItems'=>$totalCartItems,'totalCartPrice'=>$totalCartPrice,'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
        }
    }

    public function cartDelete(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            
            Cart::where('id', $data['cartId'])->delete();
            $cartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $totalCartPrice = totalCartPrice();

             // If coupon applied
            if(Session::has('couponCode')) {
                $coupon = Coupon::where('coupon_code',Session::get('couponCode'))->first()->toArray();
                if($coupon['amount_type']=="Fixed") { // Fixed Coupon
                    $couponDiscount = $coupon['amount'];
                }else { // Percentage Coupon
                    $couponDiscount = $totalCartPrice * $coupon['amount'] / 100;
                }

                $grandTotal = $totalCartPrice - $couponDiscount;
                $couponDiscount = number_format($couponDiscount, 2);
                $grandTotal = number_format($grandTotal, 2);
    
                Session::put('couponDiscount', $couponDiscount);
                Session::put('grandTotal', $grandTotal);
            }

            return response()->json(['totalCartItems'=>$totalCartItems,'totalCartPrice'=>$totalCartPrice,'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
        }
    }

    public function applyCoupon(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            
            $cartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $totalCartPrice = totalCartPrice();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();

            // Check if coupon is exist
            if($couponCount==0) {
                return response()->json([
                    'type'=>'error','message'=>'The coupon is not valid!',
                    'totalCartItems'=>$totalCartItems,
                    'totalCartPrice'=>$totalCartPrice,
                    'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
            } else { // Check for other conditions
                $couponDetails = Coupon::where('coupon_code',$data['code'])->first()->toArray();

                // Check if Coupon is active
                if($couponDetails['status'] == 0) {
                    $message = "The coupon is not active!";
                }

                $currentDate = date('Y-m-d');
                // Check if Coupon is Expired
                if($couponDetails['expiry_date'] < $currentDate) {
                    $message = "The coupon is expired!";
                }

                // Check if Coupon is available for any cart items categories
                $categories = explode(',', $couponDetails['categories']); 
                if($categories[0] != "All") {
                    foreach($cartItems as $item) {
                        if(!in_array($item['product']['category_id'],$categories)) {
                            $message = "This coupon is not eligible for one of the selected products category!";
                        }
                    }
                }

                // Check if Coupon is availbale for any cart items brands
                $brands = explode(',', $couponDetails['brands']);
                
                if($brands[0] != "All") {
                    foreach($cartItems as $item) {
                        if(!in_array($item['product']['brand_id'],$brands)) {
                            $message = "This coupon is not eligible for one of the selected products brand!";
                        }
                    }
                }

                // Check if coupon is available for selected users
                $users = explode(',', $couponDetails['users']);

                if($users[0] != "All") {
                    foreach($cartItems as $item) {
                        if(!in_array($item['user_id'],$users)) {
                            $message = "You're not eligible to use this coupon code!";
                        }
                    }
                }

                // Check if coupon can only be used to specific vendor products
                if($couponDetails['vendor_id']>0) {
                    $vendorName = VendorsBusinessDetail::select('shop_name')->where('id',$couponDetails['vendor_id'])->value('shop_name');
                    
                    foreach($cartItems as $item) {
                        if($item['product']['vendor_id']!=$couponDetails['vendor_id']) {
                            $message = "The coupon can only be used for products sold by ".$vendorName."!";
                        }
                    }
                }


                if(isset($message)) { // If one of coupon conditions is not met
                    return response()->json([
                        'status'=>false,'message'=>$message,
                        'totalCartItems'=>$totalCartItems,
                        'totalCartPrice'=>$totalCartPrice,
                        'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
                } else { // If all coupon conditions met, calculate the grand total
                    $total = 0;
                    foreach($cartItems as $item) {
                        $total += $item['product']['final_price'] * $item['quantity'];
                    }

                    if($couponDetails['amount_type']=="Fixed") { // Fixed Coupon
                        $couponDiscount = $couponDetails['amount'];
                    }else { // Percentage Coupon
                        $couponDiscount = $total * $couponDetails['amount'] / 100;
                    }

                    $grandTotal = $total - $couponDiscount;

                    Session::put('couponDiscount', number_format($couponDiscount,2));
                    Session::put('grandTotal', number_format($grandTotal,2));
                    Session::put('couponCode', $data['code']);

                    return response()->json([
                        'status'=>true, 'message'=>"Coupon is applied.",
                        'totalCartItems'=>$totalCartItems,
                        'totalCartPrice'=>$totalCartPrice,
                        'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
                }
            } 
        }
    }

    public function removeCoupon(Request $request) {
        if($request->ajax()) {
            $data = $request->all();

            Session::forget('couponDiscount');
            Session::forget('grandTotal');
            Session::forget('couponCode');

            $cartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $totalCartPrice = totalCartPrice();

            return response()->json([
                'status'=>true, 'message'=>"Coupon is removed",
                'totalCartItems'=>$totalCartItems,
                'totalCartPrice'=>$totalCartPrice,
                'view'=>(String)View::make('front.products.cart_items', compact('cartItems')),'headerView'=>(String)View::make('front.layout.header_mini_cart', compact('cartItems'))]);
        }   
    }

    public function checkout() {
        $addresses = DeliveryAddress::deliveryAddresses();
        $countries = Country::where('status', 1)->get()->toArray();
        return view('front.products.checkout', compact('addresses', 'countries'));
    }
}
