@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Category Management</h3>
                        <a href="{{ url('admin/catalogue-manage/categories') }}">Categories</a> / {{ $title}}
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
                        @if ($errors->any())
                        <br><br>
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
                        <form method="post" class="forms-sample" @if(empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$category['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="category_name"
                                    name="category_name"
                                    placeholder="Enter Category Name"
                                    @if(!empty($category['id'])) value="{{ $category['category_name'] }}" @else value="{{ old('category_name') }}" @endif
                                    />
                            </div>
                            <div>
                                <label for="section_id">Select Section</label>
                                <select class="select2single" name="section_id" id="section_id">
                                    <option value="" selected disabled>-- Select Section --</option>
                                    @foreach($getSections as $section)
                                    <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id']==$section['id']) selected @endif>{{ $section['name'] }}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div id="appendCategoriesLevel">
                                @include('admin.categories.append_categories_level')
                            </div>
                            <div class="form-group">
                                <label for="category_discount">Category Discount</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="category_discount"
                                    name="category_discount"
                                    placeholder="Enter Category Discount"
                                    @if(!empty($category['id'])) value="{{ $category['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="description">Category Description</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">@if(!empty($category['id'])){{ $category['description']}}@else{{old('description')}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="url">Category URL</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="url"
                                    name="url"
                                    placeholder="Enter Category URL"
                                    @if(!empty($category['id'])) value="{{ $category['url'] }}" @else value="{{ old('url') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="category_image"
                                  name="category_image"
                                  multiple
                                />
                                <div class="input-group col-xs-12">
                                  <input
                                    type="text"
                                    class="form-control file-upload-info"
                                    disabled
                                    placeholder="Upload Image"
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
                                @if(!empty($category['category_image']))
                                    <a target="_blank" href="{{ url('front/images/category_images/'.$category['category_image']) }}">View Image</a>&nbsp;|&nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="category-image" moduleid="{{$category['id'] }}">Delete Image</a>
                                    <input type="hidden" name="current_category_image" value="{{ $category['category_image'] }}">
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                                <input
                                type="text"
                                    class="form-control"
                                    id="meta_title"
                                    name="meta_title"
                                    placeholder="Enter Meta Title"
                                    @if(!empty($category['id'])) value="{{ $category['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                    <input
                                    type="text"
                                        class="form-control"
                                        id="meta_description"
                                        name="meta_description"
                                        placeholder="Enter Meta description"
                                        @if(!empty($category['id'])) value="{{ $category['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif
                                        />
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                    <input
                                    type="text"
                                        class="form-control"
                                        id="meta_keywords"
                                        name="meta_keywords"
                                        placeholder="Enter Meta keywords"
                                        @if(!empty($category['id'])) value="{{ $category['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif
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