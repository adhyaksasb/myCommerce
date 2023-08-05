@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users Management</h4>
                        <div class="nowrapping">
                            <h6 class="left">User Management</h6>
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
                            <table class="table table-bordered" id="users">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th class="text-center">
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Email
                                        </th>
                                        <th class="text-center">
                                            Mobile
                                        </th>
                                        <th class="text-center">
                                            Email Verified?
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
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            {{ $user['id']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $user['name']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $user['email']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $user['mobile']}}
                                        </td>
                                        <td class="text-center">
                                            {{ $user['email_verified']}}
                                        </td>
                                        <td class="text-center">
                                            @if($user['status'] == 1)
                                                <a href="javascript:void(0)" class="updateUserStatus" id="user-{{$user['id']}}" user_id="{{$user['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-check-circle" status="Active"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="updateUserStatus" id="user-{{$user['id']}}" user_id="{{$user['id']}}"><i style="font-size: 25px; color: #5c25cb;" class="mdi mdi-close-circle-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Delete User" class="confirmDelete" href="javascript:void(0)" module="user" moduleid="{{$user['id']}}"><i style="font-size: 25px; color: #5c25cb" class="mdi mdi-file-excel-box"></i></a>
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