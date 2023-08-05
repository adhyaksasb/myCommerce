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
                            <h6 class="left">Filters Values Management</h6>
                            <a href="{{ url('admin/add-edit-filter-value') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Filter Value</a>
                            <a href="{{ url('admin/catalogue-manage/filters') }}" class="btn btn-primary btn-sm font-weight-medium right mr-3">View Filters Categories</a>
                        </div>
                        @if(Session::has('error_message'))
                        <br>
                        <br>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ Session::get('error_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(Session::has('success_message'))
                        <br>
                        <br>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="filtersValues">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Filter ID
                                        </th>
                                        <th class="text-center">
                                            Filter Column
                                        </th>
                                        <th class="text-center">
                                            Filter Value
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
                                    @foreach($filtersValues as $filtersValue)
                                    <tr>
                                        <td class="text-center">
                                            {{ $filtersValue['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $filtersValue['filter_id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $filtersValue['filter']['filter_name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $filtersValue['filter_value']}}
                                        </td>
                                        <td class="text-center">
                                            @if($filtersValue['status'] == 1)
                                                <a href="javascript:void(0)" class="updateFiltersValueStatus" id="filtersValue-{{$filtersValue['id']}}" filtersValue_id="{{$filtersValue['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="updateFiltersValueStatus" id="filtersValue-{{$filtersValue['id']}}" filtersValue_id="{{$filtersValue['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/add-edit-filter-value/'.$filtersValue['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            {{-- <a title="{{ $filtersValue['name'] }} filtersValue" class="confirmDelete" href="{{ url('admin/delete-filtersValue/'.$filtersValue['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a class="confirmDelete" href="javascript:void(0)" module="filter-value" moduleid="{{$filtersValue['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
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