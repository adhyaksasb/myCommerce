@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Banners Management</h4>
                        <div class="nowrapping">
                            <h6 class="left">Banners Management</h6>
                            <a href="{{ url('admin/add-edit-banner') }}" class="btn btn-primary btn-sm font-weight-medium right">Add A Banner</a>
                        </div>
                        @if(Session::has('error_message'))
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
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success_message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="banners">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Image
                                        </th>
                                        <th class="text-center">
                                            Title
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
                                    @foreach($banners as $banner)
                                    <tr>
                                        <td class="text-center">
                                            {{ $banner['id']}}
                                        </td>
                                        <td class="text-center">
                                            <img style="width: 150px; border-radius: 0px;" src="{{ asset('front/images/banner_images/'.$banner['image']) }}" alt="">
                                        </td>
                                        <td class="text-center">
                                            {{ $banner['title']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $banner['url']}}
                                        </td>
                                        <td class="text-center">
                                            @if($banner['status'] == 1)
                                                <a href="javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-pencil-box"></i></a>
                                            {{-- <a title="{{ $banner['name'] }} Banner" class="confirmDelete" href="{{ url('admin/delete-banner/'.$banner['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a> --}}
                                            <a class="confirmDelete" href="javascript:void(0)" module="banner" moduleid="{{$banner['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
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