@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Image Management</h3>
                        <a href="{{ url('admin/catalogue-manage/products') }}">Products</a> / {{ $product['product_name'] }}
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Details</h4>
                        <form class="forms-sample">
                            <div class="form-group text-center">
                                @if(!empty($product['product_image']))
                                <img src="{{ url('front/images/product_images/small/'.$product['product_image']) }}">
                                @else
                                <img src="{{ url('front/images/product_images/small/NO IMAGE.png') }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="product_name"
                                    name="product_name"
                                    placeholder="Enter Product Name"
                                    readonly
                                    @if(!empty($product['id'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif
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
                                    readonly
                                    @if(!empty($product['id'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif
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
                                    readonly
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
                                    readonly
                                    @if(!empty($product['id'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif
                                    />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Images</h4>
                        <p class="card-description">
                            You can only add images after having the main image.
                          </p>
                        <form method="post" class="forms-sample" action="{{ url('admin/add-images/'.$product['id']) }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <input type="hidden" name="main_image" id="main_image" value="{{ $product['product_image'] }}"/>
                            </div>
                            <div class="form-group">
                                <label for="product_image">Product Image (Recommended Size: 1000x1000 px)</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="product_image"
                                  name="product_image[]"
                                  multiple
                                />
                                <div class="input-group col-xs-12">
                                  <input
                                    type="text"
                                    class="form-control file-upload-info"
                                    disabled
                                    placeholder="Upload Multiple Images"
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
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Images List</h4>
                              <p class="card-description">Edit Images</p>
                                <div class="table-responsive pt-3">
                                <table class="table table-bordered" id="images">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                ID
                                            </th>
                                            <th class="text-center">
                                                Image
                                            </th>
                                            <th class="text-center">
                                                Status
                                            </th>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($product['images'] as $image)
                                      <input style="display:none;" type="text" name="imageId[]" value="{{ $image['id']}}">
                                      <tr>
                                          <td class="text-center">
                                              {{ $image['id']}}
                                          </td>
                                          <td class="text-center">
                                              <img src="{{ url('front/images/product_images/small/'.$image['image']) }}">
                                          </td>
                                          <td class="text-center">
                                              @if($image['status'] == 1)
                                                  <a href="javascript:void(0)" class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                              @else
                                                  <a href="javascript:void(0)" class="updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                              @endif
                                          </td>
                                          <td class="text-center">
                                              <a class="confirmDelete" href="javascript:void(0)" module="image" moduleid="{{$image['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
                                          </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                                <br>
                          </div>
                      </div>
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