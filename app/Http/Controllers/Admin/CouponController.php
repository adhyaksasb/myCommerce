<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;

class CouponController extends Controller
{
    public function coupons() {
        Session::put('page', 'coupons');
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;

        if($adminType=="vendor") {
            $vendorStatus = Auth::guard('admin')->user()->status;
            if($vendorStatus == 0) {
                return redirect("admin/update-vendor-details/personal")->with('error_message','Your Vendor Account is not approved yet. Please make sure to fill all Your details information and We will check it later.');
            }
            $coupons = Coupon::where('vendor_id', $vendor_id)->get()->toArray();
        }else {
            $coupons = Coupon::get()->toArray();
        }
    
        return view('admin.coupons.coupons', compact('coupons'));
    }

    public function updateCouponStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function deleteCoupon($id) {
        Coupon::where('id', $id)->delete();
        $message = "Coupon has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditCoupon(Request $request, $id=null) {
        Session::put('page', 'coupons');
        if($id=="") {
            $title = "Add Coupon";
            $coupon = new coupon;
            $message = "Coupon has been added successfully!";   
        }else {
            $title = "Edit Coupon";
            $coupon = Coupon::find($id);
            $message = "Coupon has been updated successfully!"; 
        }
        // Get Sections with Categories and Sub-Categories
        $getCategories = Section::select('id','name')->with(['couponCategories'=>function($query) {
            $query->select('id','section_id','category_name');
        }])->get()->toArray();

        // Get All Brands
        $getBrands = Brand::select('id','name')->where('status', 1)->get()->toArray();

        // Get All Users
        $getUsers = User::where('status', 1)->get()->toArray();

        if($request->isMethod('post')) {
            $data = $request->all();

            // dd($data);

            if(isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            }else {
                $categories = "All";
            }

            if(isset($data['brands'])) {
                $brands = implode(',', $data['brands']);
            }else {
                $brands = "All";
            }

            if(isset($data['users'])) {
                $users = implode(',', $data['users']);
            }else {
                $users = "All";
            }

            if(isset($data['coupon_option'])) {
                if($data['coupon_option']=="Automatic") {
                    $coupon_code = Str::random(8);
                }else {
                    $coupon_code = $data['coupon_code'];
                }
            }

            $today = Carbon::now();
            $validTime = $today->toDateString();

            $rules = [
                'coupon_code' => 'unique:coupons,coupon_code,'.$data['id'],
                'amount' => 'required|numeric',
                'expiry_date' => 'required|after:'.$validTime
            ];

            $customMessages = [
                'coupon_code.unique' => 'Coupon already Exists'
            ];

            $this->validate($request, $rules, $customMessages);

            $adminType = Auth::guard('admin')->user()->type;
            
            if($adminType=="vendor") {
                $coupon->vendor_id = Auth::guard('admin')->user()->vendor_id;
            }else {
                $coupon->vendor_id = 0;
            }

            if(isset($data['coupon_option'])) {
                $coupon->coupon_option = $data['coupon_option'];
                $coupon->coupon_code = $coupon_code;
            }

            $coupon->coupon_type = $data['coupon_type'];
            $coupon->categories = $categories;
            $coupon->brands = $brands;
            $coupon->users = $users;
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = 1;
            $coupon->save();

            return redirect('admin/catalogue-manage/coupons')->with('success_message', $message);
        }
        return view('admin.coupons.add_edit_coupon', compact('title','coupon', 'getCategories', 'getBrands', 'getUsers'));
    }
}
