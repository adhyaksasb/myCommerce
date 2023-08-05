@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalogue Management</h3>
                        <a href="{{ url('admin/catalogue-manage/coupons') }}">Coupons</a> / {{ $title}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ Session::get('error_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form method="post" class="forms-sample" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <input type="hidden" name="id" @if(!empty($coupon['id'])) value="{{ $coupon['id'] }}" @endif>
                            @if(!empty($coupon['coupon_code']))
                            <div class="form-group" id="manualCouponField">
                              <label for="coupon_code">Coupon Code</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  id="coupon_code"
                                  name="coupon_code"
                                  disabled
                                  value="{{ $coupon['coupon_code'] }}"
                                  />
                            </div>
                            @else
                            <div class="form-group">
                                <label for="coupon_option">Coupon Option</label><br>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="coupon_option"
                                      id="automaticCoupon"
                                      value="Automatic"
                                      @if($title == "Add Coupon") checked @endif
                                      @if($title == "Edit Coupon" && $coupon['coupon_option']== "Automatic") checked @endif
                                    />
                                    Automatic
                                  </label>
                                </div>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="coupon_option"
                                      id="manualCoupon"
                                      value="Manual"
                                      @if($title == "Edit Coupon" && $coupon['coupon_option']== "Manual") checked @endif
                                    />
                                    Manual
                                  </label>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;" id="manualCouponField">
                                <label for="coupon_code">Coupon Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="coupon_code"
                                    name="coupon_code"
                                    placeholder="Enter Coupon Code"
                                    @if(!empty($coupon['coupon_code'])) value="{{ $coupon['coupon_code'] }}" @else value="{{ old('coupon_code') }}" @endif
                                    />
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="coupon_type">Coupon Type</label><br>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="coupon_type"
                                      value="Multiple"
                                      @if($title == "Add Coupon") checked @endif
                                      @if($title == "Edit Coupon" && $coupon['coupon_type']== "Multiple") checked @endif
                                    />
                                    Multiple Times
                                  </label>
                                </div>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="coupon_type"
                                      value="Single"
                                      @if($title == "Edit Coupon" && $coupon['coupon_type']== "Single") checked @endif
                                    />
                                    One Time Only
                                  </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="categories">Apply Coupon in Category</label>
                                <select class="selectCategories" name="categories[]" multiple>
                                  @php
                                    $couponCategory = explode(',', $coupon['categories']); 
                                    $couponBrand = explode(',', $coupon['brands']);
                                    $couponUser = explode(',', $coupon['users']);
                                  @endphp
                                    @foreach($getCategories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>
                                            @foreach($section['coupon_categories'] as $category)
                                                <option value="{{ $category['id'] }}" @if(!empty($coupon['categories']) && in_array($category['id'],$couponCategory)) selected @endif>&nbsp;&nbsp;&raquo;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                                @foreach($category['subcategories'] as $subcategory)
                                                    <option value="{{ $subcategory['id'] }}" @if(!empty($coupon['categories']) && in_array($subcategory['id'],$couponCategory))selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                @endforeach
                                            @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brands">Apply Coupon in Brand</label>
                                <select class="selectBrands" name="brands[]" multiple>
                                    @foreach($getBrands as $brand)
                                        <option value="{{ $brand['id'] }}" @if(!empty($coupon['brands']) && in_array($brand['id'],$couponBrand)) selected @endif>{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="users">Apply Coupon to Specific Users</label>
                                <select class="selectUsers" name="users[]" multiple>
                                    @foreach($getUsers as $user)
                                        <option value="{{ $user['id'] }}" @if(!empty($coupon['users']) && in_array($user['id'],$couponUser)) selected @endif>{{ $user['email'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount_type">Amount Type</label><br>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="amount_type"
                                      value="Percentage"
                                      @if($title == "Add Coupon") checked @endif
                                      @if($title == "Edit Coupon" && $coupon['amount_type']== "Percentage") checked @endif
                                    />
                                    Percentage (%)
                                  </label>
                                </div>
                                <div class="form-check radioCustom">
                                  <label class="form-check-label">
                                    <input
                                      type="radio"
                                      class="form-check-input"
                                      name="amount_type"
                                      value="Fixed"
                                      @if($title == "Edit Coupon" && $coupon['amount_type']== "Fixed") checked @endif
                                    />
                                    Fixed (in USD)
                                  </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    name="amount"
                                    placeholder="Enter Amount"
                                    @if(!empty($coupon['id'])) value="{{ $coupon['amount'] }}" @else value="{{ old('amount') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="expiry_date"
                                    name="expiry_date"
                                    placeholder="Enter Expiry Date"
                                    @if(!empty($coupon['id'])) value="{{ $coupon['expiry_date'] }}" @else value="{{ old('expiry_date') }}" @endif
                                    />
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer');
    <!-- partial -->
</div>
@endsection