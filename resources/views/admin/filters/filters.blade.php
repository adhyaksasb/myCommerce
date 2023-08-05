@php use App\Models\Category; @endphp
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
                            <h6 class="left">Filters Columns Management</h6>
                            <a href="{{ url('admin/add-edit-filter') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Filter</a>
                            <a href="{{ url('admin/catalogue-manage/filters-values') }}" class="btn btn-primary btn-sm font-weight-medium right mr-3">View Filters Values</a>
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
                            <table class="table table-bordered" id="filters">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Filter Name
                                        </th>
                                        <th class="text-center">
                                            Filter Column
                                        </th>
                                        <th class="text-center">
                                            Categories
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
                                    @foreach($filters as $filter)
                                    <tr>
                                        <td class="text-center">
                                            {{ $filter['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $filter['filter_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $filter['filter_column']}}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $category_ids = explode(',', $filter['category_ids']);
                                                foreach($category_ids as $category_id) {
                                                    $category_name = Category::getCategoryName($category_id);
                                                    echo $category_name.' ('.$category_id.')<br><br>';
                                                }  
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            @if($filter['status'] == 1)
                                                <a href="javascript:void(0)" class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{$filter['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{$filter['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/add-edit-filter/'.$filter['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            {{-- <a title="{{ $filter['name'] }} filter" class="confirmDelete" href="{{ url('admin/delete-filter/'.$filter['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a class="confirmDelete" href="javascript:void(0)" module="filter" moduleid="{{$filter['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
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