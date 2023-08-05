@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalogue Management</h3>
                        <a href="{{ url('admin/catalogue-manage/sections') }}">Sections</a> / {{ $title}}
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
                        <form method="post" class="forms-sample" @if(empty($section['id'])) action="{{ url('admin/add-edit-section') }}" @else action="{{ url('admin/add-edit-section/'.$section['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="section_name">Section Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="section_name"
                                    name="section_name"
                                    placeholder="Enter Section Name"
                                    @if(!empty($section['id'])) value="{{ $section['name'] }}" @else value="{{ old('section_name') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="url">Section URL</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="url"
                                    name="url"
                                    placeholder="Enter Section URL"
                                    @if(!empty($section['id'])) value="{{ $section['url'] }}" @else value="{{ old('url') }}" @endif
                                    />
                            </div>
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
@endsection