<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Image;

class BannerController extends Controller
{
    public function Banners() {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function updateBannerStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id) {
        // Get Banner Image
        $banner = Banner::select('image')->where('id',$id)->first();
        
        // Get Banner Image Path
        $banner_path = 'front/images/banner_images/'.$banner->image;

        // Delete Banner Image from banners folder if exists
        if(file_exists($banner_path)) {
            unlink($banner_path);
        }

        Banner::where('id', $id)->delete();
        $message = "Banner has been deleted successfully!";
        
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditBanner(Request $request, $id=null) {
        Session::put('page', 'banners');
        if($id=="") {
            $title = "Add Banner";
            $banner = new Banner;
            $getBanners = array();
            $message = "Banner has been added successfully!";   
        }else {
            $title = "Edit Banner";
            $banner = Banner::find($id);
            $message = "Banner has been updated successfully!"; 
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
            $validated = $request->validate([
                'title' => 'required',
                'url' => 'required',
                'alt' => 'required',
            ]);

            if($data['type']=="Slider") {
                $width = 1920;
                $height = 720;
            }else if($data['type']=="Fixed") {
                $width = 1110;
                $height = 236;
            }

            // Upload Banner Image after Resize (Small: 250x250, Medium: 500x500, Large: 1000x1000)
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = 'banner-'.rand(111,999999).'.'.$extension;
                    $imagePath = 'front/images/banner_images/'.$imageName;
                    // Upload the images
                    Image::make($image_tmp)->resize($width,$height)->save($imagePath);
                    // Insert Image Name in Banner Table
                    $banner->image = $imageName;

                    // Delete Previous Photo from banner_images folder if exists
                    if(!empty($data['current_banner_image'])) {
                        $current_banner = 'front/images/banner_images/'.$data['current_banner_image'];
                        if(file_exists($current_banner)) {
                            unlink($current_banner);
                        }
                    }
                }
            }

            $banner->type = $data['type'];
            $banner->title = $data['title'];
            $banner->url = $data['url'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();

            return redirect('admin/banner-manage/banners')->with('success_message', $message);
        }
        return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }
}
