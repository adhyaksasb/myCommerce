@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Product Management</h3>
                        <a href="{{ url('admin/catalogue-manage/products') }}">Products</a> / {{ $title }}
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
                        <form method="post" class="forms-sample" @if(empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select class="select2single" name="category_id" id="category_id">
                                    <option value="" selected disabled>-- Select Category --</option>
                                    @foreach($getCategories as $section)
                                        <optgroup label="{{ $section['name'] }}"></optgroup>
                                            @foreach($section['categories'] as $category)
                                                <option value="{{ $category['id'] }}" @if(!empty($product['category_id']) && $category['id']==$product['category_id']) selected @endif>&nbsp;&nbsp;&raquo;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                                @foreach($category['subcategories'] as $subcategory)
                                                    <option value="{{ $subcategory['id'] }}" @if(!empty($product['category_id']) && $subcategory['id']==$product['category_id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                @endforeach
                                            @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="loadFilters">
                                @include('admin.filters.category_filters')
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Select Brand</label>
                                <select class="select2single" name="brand_id" id="brand_id">
                                    <option value="" selected disabled>-- Select Brand --</option>
                                    @foreach($getBrands as $brand)
                                        <option value="{{ $brand['id'] }}" @if(!empty($product['brand_id']) && $brand['id']==$product['brand_id']) selected @endif>{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="product_name"
                                    name="product_name"
                                    placeholder="Enter Product Name"
                                    required
                                    @if(!empty($product['id'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_code">Product Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="product_code"
                                    name="product_code"
                                    placeholder="Enter Product Code"
                                    required
                                    @if(!empty($product['id'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price (USD)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="product_price"
                                    name="product_price"
                                    placeholder="Enter Product Price (in USD)"
                                    step=".01"
                                    required
                                    @if(!empty($product['id'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Product Discount (%)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="product_discount"
                                    name="product_discount"
                                    placeholder="Enter Product Discount (%)"
                                    @if(!empty($product['id'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_color">Product Color</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="product_color"
                                    name="product_color"
                                    placeholder="Enter Product Color"
                                    @if(!empty($product['id'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="group_code">Variant Group Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="group_code"
                                    name="group_code"
                                    placeholder="Enter Variant Group Code (Optional)"
                                    @if(!empty($product['id'])) value="{{ $product['group_code'] }}" @else value="{{ old('group_code') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_weight">Product Weight (Grams)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="product_weight"
                                    name="product_weight"
                                    placeholder="Enter Product Weight (in Grams)"
                                    step=".01"
                                    required
                                    @if(!empty($product['id'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea class="form-control" name="product_description" id="product_description" cols="30" rows="10">@if(!empty($product['id'])){{ $product['product_description']}}@else{{ old('product_description')}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_image">Product Image (Recommended Size: 1000x1000 px)</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="product_image"
                                  name="product_image"
                                />
                                <div class="input-group col-xs-12">
                                  <input
                                    type="text"
                                    class="form-control file-upload-info"
                                    disabled
                                    placeholder="Upload Image"
                                  />
                                  <span class="input-group-append">
                                    <button
                                      class="file-upload-browse btn btn-primary"
                                      type="button"
                                    >
                                      Upload
                                    </button>
                                  </span>
                                </div>
                                @if(!empty($product['product_image']))
                                    <a target="_blank" href="{{ url('front/images/product_images/large/'.$product['product_image']) }}">View Image</a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="product-image" moduleid="{{$product['id'] }}">Delete Image</a>
                                    <input type="hidden" name="current_product_image" value="{{ $product['product_image'] }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="product_video">Product Video (Recommended Size: Less than 2 MB)</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="product_video"
                                  name="product_video"
                                />
                                <div class="input-group col-xs-12">
                                  <input
                                    type="text"
                                    class="form-control file-upload-info"
                                    disabled
                                    placeholder="Upload Video"
                                  />
                                  <span class="input-group-append">
                                    <button
                                      class="file-upload-browse btn btn-primary"
                                      type="button"
                                    >
                                      Upload
                                    </button>
                                  </span>
                                </div>
                                @if(!empty($product['product_video']))
                                    <a target="_blank" href="{{ url('front/videos/product_videos/'.$product['product_video']) }}">View Video</a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="product-video" moduleid="{{$product['id'] }}">Delete Video</a>
                                    <input type="hidden" name="current_product_video" value="{{ $product['product_video'] }}">
                                @endif
                              </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input
                                type="text"
                                    class="form-control"
                                    id="meta_title"
                                    name="meta_title"
                                    placeholder="Enter Meta Title"
                                    @if(!empty($product['id'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="meta_description"
                                    name="meta_description"
                                    placeholder="Enter Meta description"
                                    @if(!empty($product['id'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif
                                />
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="meta_keywords"
                                    name="meta_keywords"
                                    placeholder="Enter Meta keywords"
                                    @if(!empty($product['id'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif
                                />
                            </div>
                            <div class="d-flex">
                                <h5>Featured Items?</h5>&nbsp;&nbsp;&nbsp;
                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="is_featured" id="is_featured" value="Yes"
                                        @if(!empty($product['is_featured'] && $product['is_featured']=="Yes")) checked @endif />
                                    </label>
                                  </div>
                            </div>
                            <div class="d-flex">
                                <h5 style="margin-right: 42px">Best Seller?</h5>
                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="is_bestseller" id="is_bestseller" value="Yes"
                                        @if(!empty($product['is_bestseller'] && $product['is_bestseller']=="Yes")) checked @endif />
                                    </label>
                                  </div>
                            </div>
                            <br>
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
<script src="{{ url('admin/js/filter.js') }}"></script>
@endsection