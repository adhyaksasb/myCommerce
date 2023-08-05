<?php

use Illuminate\Support\Facades\Route;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Section;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// ---------------------------------- ADMIN PANEL ---------------------------------- //
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function() {
    // Admin Login Route
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware'=>['admin']], function() {
        
        // Admin Dashboard Route
        Route::get('dashboard','AdminController@dashboard');

        // Update Admin Password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');

        // Check Admin Password
        Route::post('check-admin-password','AdminController@checkAdminPassword');

        // Update Admin Details
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        // Update Vendor Details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');

        // View Admins/ Subadmins / Vendors
        Route::get('admin-manage/{type?}', 'AdminController@admins');

        // View Vendor Details
        Route::get('admin-manage/vendor-details/{id}', 'AdminController@viewVendorDetails');

        // Update Admin Status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');

        // Admin Logout
        Route::get('logout', 'AdminController@logout');

        // Sections
        Route::get('catalogue-manage/sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        Route::get('delete-section/{id}', 'SectionController@deleteSection');
        Route::match(['get','post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');

        // Categories
        Route::get('catalogue-manage/categories','CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get','post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::get('append-categories-level', 'CategoryController@appendCategorieslevel');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');

        // Brands
        Route::get('catalogue-manage/brands', 'BrandController@brands');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        Route::match(['get','post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');

        // Products
        Route::get('catalogue-manage/products','ProductController@Products');
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        Route::match(['get','post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('append-products-level', 'ProductController@appendProductslevel');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');

        // Attributes for Products
        Route::match(['get','post'], 'add-edit-attributes/{id?}', 'ProductController@addEditAttributes');
        Route::post('update-attribute-status', 'ProductController@updateAttributeStatus');
        Route::get('delete-attribute/{id}', 'ProductController@deleteAttribute');
        Route::match(['get','post'], 'edit-attributes/{id}', 'ProductController@editAttributes');
        

        // Images for Products
        Route::match(['get','post'], 'add-images/{id}', 'ProductController@addImages');
        Route::get('delete-image/{id}', 'ProductController@deleteImage');
        Route::post('update-image-status', 'ProductController@updateImageStatus');

        // Filters
        Route::get('catalogue-manage/filters', 'FilterController@filters');
        Route::post('update-filter-status', 'FilterController@updateFilterStatus');
        Route::get('delete-filter/{id}', 'FilterController@deleteFilter');
        Route::match(['get','post'], 'add-edit-filter/{id?}', 'FilterController@addEditFilter');
        Route::post('category-filters', 'FilterController@categoryFilters');

        // Filters Values
        Route::get('catalogue-manage/filters-values', 'FilterController@filtersValues');
        Route::post('update-filter-values-status', 'FilterController@updateFiltersValueStatus');
        Route::get('delete-filter-value/{id}', 'FilterController@deleteFilterValues');
        Route::match(['get','post'], 'add-edit-filter-value/{id?}', 'FilterController@addEditFilterValues');

        // Coupon
        Route::get('catalogue-manage/coupons','CouponController@coupons');
        Route::post('update-coupon-status', 'CouponController@updateCouponStatus');
        Route::get('delete-coupon/{id}', 'CouponController@deleteCoupon');
        Route::match(['get','post'], 'add-edit-coupon/{id?}', 'CouponController@addEditCoupon');

        // Banners
        Route::get('banner-manage/banners','BannerController@Banners');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannerController@deleteBanner');
        Route::match(['get','post'], 'add-edit-banner/{id?}', 'BannerController@addEditBanner');

        // Users
        Route::get('user-manage/users','UserController@Users');
        Route::post('update-user-status', 'UserController@updateUserStatus');
        Route::get('delete-user/{id}', 'UserController@deleteUser');
    });
});

// ---------------------------------- FRONT-END ---------------------------------- //
Route::namespace('App\Http\Controllers\Front')->group(function() {
    Route::get('/','IndexController@index');

    // Category Directories
    // Route::get('/c','IndexController@directory');


    // Products Listing Routes //
        // Section URL
        $sectionUrls = Section::select('url')->where('status',1)->get()->pluck('url')->toArray();

        // Category URL
        $categoryUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();

        $listingUrls = array_merge($sectionUrls, $categoryUrls);

        foreach($listingUrls as $key => $url) {
            Route::match(['get','post'],'c/'.$url, 'ProductController@listing');
        }

    
    // Vendor Login/Register
    Route::get('vendor/login-register','VendorController@loginRegister');
    
    // Vendor Register
    Route::post('vendor/register', 'VendorController@vendorRegister');

    // Confirm Vendor Account
    Route::get('vendor/confirm/{code}','VendorController@confirmVendor');



    Route::group(['middleware'=>'guest'], function() {
        // User Login/Register
        Route::get('user/login-register','UserController@loginRegister');
        
        // User Register
        Route::match(['get','post'], 'user/register', 'UserController@userRegister');
        
        // User Login
        Route::match(['get','post'], 'user/login', 'UserController@userLogin');

        // User Login after OTP
        Route::match(['get','post'], 'user/login/otp', 'UserController@userLoginOTP');

        // User Forgot Password
        Route::match(['get','post'], 'user/forgot-password', 'UserController@forgotPassword');

        // Confirm User Account
        Route::get('user/confirm/{code}','UserController@confirmUser');
    });

    Route::group(['middleware'=>'auth'], function() {    
        // User Profile Management
        Route::match(['get','post'], 'user/settings', 'UserController@userSettings');

        // User Update Password
        Route::match(['get','post'], 'user/update-password', 'UserController@userUpdatePassword');

        // Resend Email
        Route::match(['get','post'], 'resend-email-confirmation', 'UserController@resendEmail');

        // Get Address
        Route::match(['get','post'], 'address/get', 'UserController@getAddress');

        // Add Address
        Route::match(['get','post'], 'address/add', 'UserController@addAddress');

        // Delete Address
        Route::match(['get','post'], 'address/delete', 'UserController@deleteAddress');

        // Apply Coupon
        Route::match(['get','post'], 'apply-coupon', 'ProductController@applyCoupon');

        // Remove Coupon
        Route::match(['get','post'], 'remove-coupon', 'ProductController@removeCoupon');

        // Checkout
        Route::match(['get','post'], 'checkout', 'ProductController@checkout');

        
    });


    // User Logout
    Route::get('user/logout', 'UserController@userLogout');
    
    // Admin Products Page
    Route::get('store/mycommerce/0', 'ProductController@adminListing');

    // Vendor Products Page
    Route::get('store/{storeUrl}/{vendorid}', 'ProductController@vendorListing');

    // Product Detail Page
    Route::get('{url}/{id}','ProductController@detail');

    // Get Product Attributes Price
    Route::post('get-product-price','ProductController@getProductPrice');

    // Add to Cart Route
    Route::post('cart/add', 'ProductController@cartAdd');

    // Cart Page
    Route::get('cart', 'ProductController@cart');

    // Update Cart Items Quantity
    Route::post('cart/update', 'ProductController@cartUpdate');

    // Delete Cart Item
    Route::post('cart/delete', 'ProductController@cartDelete');

});




