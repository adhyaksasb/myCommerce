<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\ProductsFilter;
use Auth;
use Session;
use Image;

class ProductController extends Controller
{
    public function Products() {
        Session::put('page', 'products');
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if($adminType=="vendor") {
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus == 0) {
                return redirect("admin/update-vendor-details/personal")->with('error_message','Your Vendor Account is not approved yet. Please make sure to fill all Your details information and We will check it later.');
            }
        }
        // Get Products List
        $products = Product::with(['section'=>function($query) {
            $query->select('id','name');
        },'category'=>function($query) {
            $query->select('id','category_name');
        },'brand'=>function($query) {
            $query->select('id','name');
        },'admin'=>function($query) {
            $query->select('id','name');
        }]);

        if($adminType =="vendor") {
            $products = $products->where('vendor_id', $vendor_id);
        }

        $products = $products->get()->toArray();
        return view('admin.products.products')->with(compact('products', 'adminType'));
    }

    public function updateProductStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function addEditProduct(Request $request, $id=null) {
        Session::put('page', 'products');
        if($id=="") {
            $title = "Add Product";
            $product = new Product;
            $getProducts = array();
            $message = "Product has been added successfully!";   
        }else {
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product has been updated successfully!"; 
        }

        // Get Sections with Categories and Sub-Categories
        $getCategories = Section::with('categories')->get()->toArray();

        // Get Category Filter
        $productFilters = ProductsFilter::productFilters();

        // Get All Brands
        $getBrands = Brand::where('status', 1)->get()->toArray();

        if($request->isMethod('post')) {
            $data = $request->all();
            
            $validated = $request->validate([
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_price' => 'required',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ]);

            if($data['product_description']==NULL) {
                $data['product_description'] = "No Description";
            }

            if($data['product_discount']=="") {
                $data['product_discount'] = 0;
            }

            // Upload Product Image after Resize (Small: 250x250, Medium: 500x500, Large: 1000x1000)
            if($request->hasFile('product_image')) {
                $random = Str::random(40);
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = $random.'.'.$extension;
                    $largeImagePath = 'front/images/product_images/large/'.$imageName;
                    $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                    $smallImagePath = 'front/images/product_images/small/'.$imageName;
                    // Upload the Large, Medium, and Small images after resize
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    // Insert Image Name in Product Table
                    $product->product_image = $imageName;

                    // Delete Previous Photo from banner_images folder if exists
                    if(!empty($data['current_product_image'])) {
                        $product_large_path = 'front/images/product_images/large/'.$data['current_product_image'];
                        $product_medium_path = 'front/images/product_images/medium/'.$data['current_product_image'];
                        $product_small_path = 'front/images/product_images/small/'.$data['current_product_image'];
                        if(file_exists($product_large_path) || file_exists($product_medium_path) || file_exists($product_small_path)) {
                            unlink($product_large_path);
                            unlink($product_medium_path);
                            unlink($product_small_path);
                        }
                    }
                }
            }else if(!empty($data['current_product_image'])) {
                $imageName = $data['current_product_image'];
            }else {
                $imageName = "";
            }

            // Upload Product Video
            if($request->hasFile('product_video')) {
                $random = Str::random(40);
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()) {
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $random.'.'.$extension;
                    $videoPath = 'front/videos/product_videos/';

                    $video_tmp->move($videoPath,$videoName);
                    // Insert Video Name in Product Table
                    $product->product_video = $videoName;

                    // Delete Previous Photo from banner_images folder if exists
                    if(!empty($data['current_product_video'])) {
                        $current_video = 'front/videos/product_videos/'.$data['current_product_video'];
                        if(file_exists($current_video)) {
                            unlink($current_video);
                        }
                    }
                }
            }else if(!empty($data['current_product_video'])) {
                $videoName = $data['current_product_video'];
            }else {
                $videoName = "";
            }

            // Save Product details in products table
            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;
            $categoryDetails = Category::find($data['category_id']);

            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            foreach($productFilters as $filter) {
                $filterAvailable = ProductsFilter::filterAvailable( $filter['id'], $data['category_id']);
                if($filterAvailable == "Yes") {
                    if(isset($filter['filter_column']) && $data[$filter['filter_column']]) {
                        $product->{$filter['filter_column']} = $data[$filter['filter_column']];
                    }
                }
            }

            if($adminType=="vendor") {
                $product->vendor_id = $vendor_id;
            }else {
                $product->vendor_id = 0;
            }

            $product->admin_id = $admin_id;
            $product->admin_type = $adminType;
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_price = $data['product_price'];
            $product->product_color = $data['product_color'];
            $product->group_code = $data['group_code'];
            $product->product_discount = $data['product_discount'];
            
            if($data['product_discount']>0) {
                $product->final_price = $data['product_price'] - ($data['product_price']*$data['product_discount']/100);
            }else{
                $product->final_price = $data['product_price'];       
            }

            // Make Dynamic URL based on Product Brand, Product Name, & Product Color
                // Get Brand Name
                $brandName = Brand::select('name')->where('id',$data['brand_id'])->value('name');
                $brandUrl =  strtolower(str_replace([' ','&','/'], '-', $brandName));

                // Format Product Name to URL
                $productUrl = strtolower(str_replace([' ','&','/'], '-', $data['product_name']));

                // Format Product Color to URL
                $colorUrl = strtolower(str_replace([' ','&','/'], '-', $data['product_color']));

                // Insert Dynamic URL to Products Table
                $product->product_url = $brandUrl.'-'.$productUrl.'-'.$colorUrl;

            $product->product_weight = $data['product_weight'];
            $product->product_description = $data['product_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if(!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            }else {
                $product->is_featured = "No";
            }
            if(!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            }else {
                $product->is_bestseller = "No";
            }
            $product->status = 1;
            $product->save();

            return redirect('admin/catalogue-manage/products')->with('success_message', $message);
        }
        return view('admin.products.add_edit_product')->with(compact('title','product','getCategories','getBrands'));
    }


    public function deleteProduct($id) {
        // Get Main Product Image
        $productImage = Product::select('product_image')->where('id',$id)->first();
        
        if(!empty($productImage->product_image)) {
        // Get Product Image Path
        $product_image_large_path = 'front/images/product_images/large/'.$productImage->product_image;
        $product_image_medium_path = 'front/images/product_images/medium/'.$productImage->product_image;
        $product_image_small_path = 'front/images/product_images/small/'.$productImage->product_image;

            // Delete Product Image from product_images folder if exists
            if(file_exists($product_image_large_path) || file_exists($product_image_medium_path) || file_exists($product_image_small_path)) {
                unlink($product_image_large_path);
                unlink($product_image_medium_path);
                unlink($product_image_small_path);
            }
        }

        // Get Product Multiple Images
        $productImages = ProductsImage::select('image')->where('product_id',$id)->get()->toArray();
        
        if(!empty($productImages)) {
            foreach($productImages as $key => $product) {
                // Get Product Image Path
                $product_image_large_path = 'front/images/product_images/large/'.$product['image'];
                $product_image_medium_path = 'front/images/product_images/medium/'.$product['image'];
                $product_image_small_path = 'front/images/product_images/small/'.$product['image'];

                // Delete Product Image from product_images folder if exists
                if(file_exists($product_image_large_path) || file_exists($product_image_medium_path) || file_exists($product_image_small_path)) {
                    unlink($product_image_large_path);
                    unlink($product_image_medium_path);
                    unlink($product_image_small_path);
                }
            }
        }


        // Get Product Video
        $productVideo = Product::select('product_video')->where('id',$id)->first();

        if(!empty($productVideo->product_video)) {
                    
        // Get Product Video Path
        $product_video_path = 'front/videos/product_videos/'.$productVideo->product_video;

            // Delete Product Video from product_videos folder if exists
            if(file_exists($product_video_path)) {
                unlink($product_video_path);
            }
        }   

        Product::where('id', $id)->delete();
        ProductsAttribute::where('product_id', $id)->delete();
        ProductsImage::where('product_id', $id)->delete();
        $message = "Product has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductImage($id) {
        // Get Product Image
        $productImage = Product::select('product_image')->where('id',$id)->first();
        
        // Get Product Image Path
        $product_image_large_path = 'front/images/product_images/large/'.$productImage->product_image;
        $product_image_medium_path = 'front/images/product_images/medium/'.$productImage->product_image;
        $product_image_small_path = 'front/images/product_images/small/'.$productImage->product_image;

        // Delete Product Image from product_images folder if exists
        if(file_exists($product_image_large_path) || file_exists($product_image_medium_path) || file_exists($product_image_small_path)) {
            unlink($product_image_large_path);
            unlink($product_image_medium_path);
            unlink($product_image_small_path);
        }

        // Delete Product image from products table
        Product::where('id',$id)->update(['product_image'=>'']);

        $message = "Product Image has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductVideo($id) {
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id',$id)->first();
        
        // Get Product Video Path
        $product_video_path = 'front/videos/product_videos/'.$productVideo->product_video;

        // Delete Product Video from product_videos folder if exists
        if(file_exists($product_video_path)) {
            unlink($product_video_path);
        }



        // Delete Product video from products table
        Product::where('id',$id)->update(['product_video'=>'']);

        $message = "Product Video has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditAttributes(Request $request, $id) {
        Session::put('page', 'products');
        $product = Product::select('id','product_name','product_color','product_code','product_price','product_image')->with('attributes')->find($id);

        if($request->isMethod('post')) {
            $data = $request->all();

            foreach($data['sku'] as $key => $value) {
                if(!empty($value)) {

                    //SKU Duplicate Check
                    $skuCount = ProductsAttribute::where('sku',$value)->count();
                    if($skuCount>0) {
                        return redirect()->back()->with('error_message', 'SKU already exist! Please add another SKU!');
                    }

                    //Size Duplicate Check
                    $sizeCount = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($sizeCount>0) {
                        return redirect()->back()->with('error_message', 'Size already exist! Please add another Size!');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            return redirect()->back()->with('success_message','Product Attributes has been added successfully');
        }
        return view('admin.attributes.add_edit_attributes')->with(compact('product'));  
    }

    public function updateAttributeStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function deleteAttribute($id) {
        ProductsAttribute::where('id', $id)->delete();
        $message = "Attribute has been deleted successfully!";
        return redirect()->back()->with('attribute_message', $message);
    }

    public function editAttributes(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            foreach($data['attributeId'] as $key => $attribute) {
                if(!empty($attribute)) {
                    ProductsAttribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],
                    'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('attribute_message','Product attributes has been updated successfully');
        }
    }

    public function addImages(Request $request, $id) {
        Session::put('page', 'products');
        $product = Product::select('id','product_name','product_color','product_code','product_price','product_image')->with('images')->find($id);
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if(!empty($data['main_image'])) {
                if($request->hasFile('product_image')) {
                    $images = $request->file('product_image');
                    
                    foreach($images as $key => $image) {
                        $random = Str::random(7);
                        $imageCount = ProductsImage::where('image','like',substr($data['main_image'],0,40).'%')->count();
                        // Get Image Extension
                        $image_tmp = Image::make($image);
                        $image_name = $image->getClientOriginalName();
                        $extension = $image->getClientOriginalExtension();
                        // Generate New Image Name
                        if(!empty($data['main_image'])) {
                            $imageName = substr($data['main_image'],0,40).'-'.$imageCount.'.'.$extension;
                        }else {
                            $imageName = $random.'-'.$random.'.'.$extension;
                        }
    
                        $largeImagePath = 'front/images/product_images/large/'.$imageName;
                        $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                        $smallImagePath = 'front/images/product_images/small/'.$imageName;
                        // Upload the Large, Medium, and Small images after resize
                        Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                        Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                        // Insert Image Name in Product Table
                        $image = new ProductsImage;
                        $image->image = $imageName;
                        $image->product_id = $id;
                        $image->status = 1;
                        $image->save();
                    }
                }
                return redirect()->back()->with('success_message', 'Product Images has been added successfully!');
            }else {
                return redirect()->back()->with('error_message', 'Please Add Main Product Image First!');
            }
        }
        return view('admin.images.add_images')->with(compact('product'));
    }

    public function deleteImage($id) {
        // Get Product Image
        $productImage = ProductsImage::select('image')->where('id',$id)->first();
        $image = json_decode(json_encode($productImage), true);
        $imageValue = $image['image'];
        
        // Get Product Image Path
        $product_image_large_path = 'front/images/product_images/large/'.$imageValue;
        $product_image_medium_path = 'front/images/product_images/medium/'.$imageValue;
        $product_image_small_path = 'front/images/product_images/small/'.$imageValue;

        // Delete Product Image from product_images folder if exists
        if(file_exists($product_image_large_path) || file_exists($product_image_medium_path) || file_exists($product_image_small_path)) {
            unlink($product_image_large_path);
            unlink($product_image_medium_path);
            unlink($product_image_small_path);
        }

        ProductsImage::where('id', $id)->delete();
        $message = "Image has been deleted successfully!";
        
        return redirect()->back()->with('success_message', $message);
    }

    public function updateImageStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);
        }
    }
}
