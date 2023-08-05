@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Catalogue Management</h4>
                        <div class="nowrapping">
                            <h6 class="left">Categories Management</h6>
                            <a href="{{ url('admin/add-edit-category') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Category</a>
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
                            <table class="table table-bordered" id="categories">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Category
                                        </th>
                                        <th class="text-center">
                                            Parent Category
                                        </th>
                                        <th class="text-center">
                                            Section
                                        </th>
                                        <th class="text-center">
                                            URL
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
                                    @foreach($categories as $category)
                                    @if(isset($category['parent_category']['category_name'])&&!empty($category['parent_category']['category_name']))
                                        @php $parent_category = $category['parent_category']['category_name']; @endphp
                                    @else
                                        @php $parent_category = "Root"; @endphp
                                    @endif
                                    <tr>
                                        <td class="text-center">
                                            {{ $category['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $category['category_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{$parent_category}}
                                        </td>
                                        <td class="text-center">
                                            {{ $category['section']['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $category['url']}}
                                        </td>
                                        <td class="text-center">
                                            @if($category['status'] == 1)
                                                <a href="javascript:void(0)" class="updatecategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updatecategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/add-edit-category/'.$category['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            {{-- <a title="{{ $category['name'] }} category" class="confirmDelete" href="{{ url('admin/delete-category/'.$category['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a class="confirmDelete" href="javascript:void(0)" module="category" moduleid="{{$category['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer');
    </div>
</div>
@endsection