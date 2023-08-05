@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            @if($adminType == "vendor")
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Catalogue Management</h4>
                        <div class="nowrapping">
                            <h6 class="left">Product Management</h6>
                            <a href="{{ url('admin/add-edit-product') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Product</a>
                        </div>
                        @if(Session::has('error_message'))
                        <br><br>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ Session::get('error_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::has('success_message'))
                        <br><br>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="products">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Product Name
                                        </th>
                                        <th class="text-center">
                                            Product Code
                                        </th>
                                        <th class="text-center">
                                            Brand
                                        </th>
                                        <th class="text-center">
                                            Product Color
                                        </th>
                                        <th class="text-center">
                                            Product Image
                                        </th>
                                        <th class="text-center">
                                            Category
                                        </th>
                                        <th class="text-center">
                                            Section
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
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            {{ $product['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_code']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['brand']['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_color']}}
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($product['product_image']))
                                            <img style="width: 75px; height: 75px;" src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}" />
                                            @else
                                            <img style="width: 75px; height: 75px;" src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}" />
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $product['category']['category_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['section']['name']}}
                                        </td>
                                        <td class="text-center">
                                            @if($product['status'] == 1)
                                                <a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Product" id="editProduct" href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            <a title="Add & Edit Attributes" href="{{ url('admin/add-edit-attributes/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-plus-box"></i></a>
                                            <a title="Add Multiple Images" href="{{ url('admin/add-images/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-library-plus"></i></a>
                                            {{-- <a title="{{ $product['name'] }} product" class="confirmDelete" href="{{ url('admin/delete-product/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a title="Delete Product" class="confirmDelete" href="javascript:void(0)" module="product" moduleid="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Catalogue Management</h4>
                        <div class="nowrapping">
                            <h6 class="left">Product Management</h6>
                            <a href="{{ url('admin/add-edit-product') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Product</a>
                        </div>
                        @if(Session::has('error_message'))
                        <br><br>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ Session::get('error_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::has('success_message'))
                        <br><br>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="products">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Product Name
                                        </th>
                                        <th class="text-center">
                                            Product Code
                                        </th>
                                        <th class="text-center">
                                            Brand
                                        </th>
                                        <th class="text-center">
                                            Product Color
                                        </th>
                                        <th class="text-center">
                                            Product Image
                                        </th>
                                        <th class="text-center">
                                            Category
                                        </th>
                                        <th class="text-center">
                                            Section
                                        </th>
                                        <th class="text-center">
                                            Added By
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
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            {{ $product['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_code']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['brand']['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['product_color']}}
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($product['product_image']))
                                            <img style="width: 75px; height: 75px;" src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}" />
                                            @else
                                            <img style="width: 75px; height: 75px;" src="{{ asset('front/images/product_images/small/NO IMAGE.png') }}" />
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $product['category']['category_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $product['section']['name']}}
                                        </td>
                                        <td class="text-center">
                                            @if($product['admin_type']=="vendor")
                                                <a href="{{ url('admin/admin-manage/vendor-details/'.$product['admin_id']) }}">{{ $product['admin']['name']}}</a>
                                            @else
                                                {{ ucfirst($product['admin_type'])}}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($product['status'] == 1)
                                                <a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Product" id="editProduct" href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            <a title="Add & Edit Attributes" href="{{ url('admin/add-edit-attributes/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-plus-box"></i></a>
                                            <a title="Add Multiple Images" href="{{ url('admin/add-images/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-library-plus"></i></a>
                                            {{-- <a title="{{ $product['name'] }} product" class="confirmDelete" href="{{ url('admin/delete-product/'.$product['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a title="Delete Product" class="confirmDelete" href="javascript:void(0)" module="product" moduleid="{{$product['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer');
    </div>
</div>
@endsection