@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Attribute Management</h3>
                        <a href="{{ url('admin/catalogue-manage/products') }}">Products</a> / {{ $product['product_name'] }}
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('attribute_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ Session::get('attribute_message')}}
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
                        <h4 class="card-title">Add Attributes</h4>
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
                        <form method="post" class="forms-sample" action="{{ url('admin/add-edit-attributes/'.$product['id']) }}">@csrf
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input class="border border-dark" style="width:150px;" type="text" name="size[]" id="size" placeholder="Size" required/>
                                        <input class="border border-dark" style="width:150px;" type="text" name="price[]" id="price" placeholder="Price" required/>
                                        <input class="border border-dark" style="width:150px;" type="text" name="stock[]" id="stock" placeholder="Stock" required/>
                                        <input class="border border-dark" style="width:150px;" type="text" name="sku[]" id="sku" placeholder="SKU" required/>
                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Attributes List</h4>
                    <p class="card-description">Edit Attributes</p>
                    @if(Session::has('attribute_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('attribute_message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive pt-3">
                        <form method="post" action="{{ url('admin/edit-attributes/'.$product['id']) }}">@csrf
                            <table class="table table-bordered" id="attributes">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Size
                                        </th>
                                        <th class="text-center">
                                            SKU
                                        </th>
                                        <th class="text-center">
                                            Price
                                        </th>
                                        <th class="text-center">
                                            Stock
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
                                    @foreach($product['attributes'] as $attribute)
                                    <input style="display:none;" type="text" name="attributeId[]" value="{{ $attribute['id']}}">
                                    <tr>
                                        <td class="text-center">
                                            {{ $attribute['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $attribute['size']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $attribute['sku']}}
                                        </td>
                                        <td class="text-center">
                                            <input style="width:80px;" type="number" name="price[]" value="{{ $attribute['price']}}" step=".01" required>
                                        </td>
                                        <td class="text-center">
                                            <input style="width:80px;" type="number" name="stock[]" value="{{ $attribute['stock']}}" required>
                                        </td>
                                        <td class="text-center">
                                            @if($attribute['status'] == 1)
                                                <a href="javascript:void(0)" class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/add-edit-attribute/'.$attribute['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            {{-- <a title="{{ $attribute['name'] }} attribute" class="confirmDelete" href="{{ url('admin/delete-attribute/'.$attribute['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a class="confirmDelete" href="javascript:void(0)" module="attribute" moduleid="{{$attribute['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <button type="submit" class="btn btn-primary mr-2">
                                Update Attributes
                            </button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
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