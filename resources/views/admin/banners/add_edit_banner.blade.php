@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Banner Management</h3>
                        <a href="{{ url('admin/banner-manage/banners') }}">Banners</a> / {{ $title}}
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
                        <form method="post" class="forms-sample" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="type">Banner Type</label>
                                <select class="select2single" name="type" id="type">
                                    <option value="" selected disabled>Select Banner</option>
                                    <option value="Slider" @if(!empty($banner['type']) && $banner['type']=="Slider") selected @endif>Slider</option>
                                    <option value="Fixed" @if(!empty($banner['type']) && $banner['type']=="Fixed") selected @endif>Fixed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Banner Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    name="title"
                                    placeholder="Enter Banner Title"
                                    @if(!empty($banner['id'])) value="{{ $banner['title'] }}" @else value="{{ old('title') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="url">Banner URL</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="url"
                                    name="url"
                                    placeholder="Enter Banner URL"
                                    @if(!empty($banner['id'])) value="{{ $banner['url'] }}" @else value="{{ old('url') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="alt">Banner Alternative Text</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="alt"
                                    name="alt"
                                    placeholder="Enter Banner Alternative Text"
                                    @if(!empty($banner['id'])) value="{{ $banner['alt'] }}" @else value="{{ old('alt') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="image">Banner Image (Rec Size for Slider: 1920x720px, for Fixed: 1110x236px)</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="image"
                                  name="image"
                                  multiple
                                />
                                <div class="input-group col-xs-12">
                                  <input
                                    type="text"
                                    class="form-control file-upload-info"
                                    disabled
                                    placeholder="Upload Banner"
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
                                @if(!empty($banner['image']))
                                    <a target="_blank" href="{{ url('front/images/banner_images/'.$banner['image']) }}">View Image</a>
                                    <input style="display:none;" type="text" name="current_banner_image" value="{{ $banner['image'] }}">
                                @endif
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