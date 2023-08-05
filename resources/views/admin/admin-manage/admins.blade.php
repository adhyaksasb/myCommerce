@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>
                        {{-- <p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p> --}}
                        <div class="alert alert-primary alert-dismissible fade show loaderAjax" role="alert">
                            <strong>Loading!</strong> Processing update status Admin
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="admins">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Admin ID
                                        </th>
                                        <th class="text-center">
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Type
                                        </th>
                                        <th class="text-center">
                                            Email
                                        </th>
                                        <th class="text-center">
                                            Mobile
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
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td class="text-center">
                                            {{ $admin['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $admin['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ ucfirst($admin['type']) }}
                                        </td>
                                        <td class="text-center">
                                            {{ $admin['email']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $admin['mobile']}}
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($admin['image'] && file_exists('admin/images/photos/'.$admin['image'])))
                                                <img src="{{ asset('admin/images/photos/'.$admin['image']) }}">
                                            @else
                                                <img src="{{ asset('admin/images/photos/dummy.jpg') }}">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($admin['status'] == 1)
                                                <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($admin['type']=='vendor')
                                            <a href="{{ url('admin/admin-manage/vendor-details/'.$admin['id']) }}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-document"></i></a>
                                            @endif
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