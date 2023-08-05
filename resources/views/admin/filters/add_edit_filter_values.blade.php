@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Catalogue Management</h3>
                        <a href="{{ url('admin/catalogue-manage/filters-values') }}">Filter Values</a> / {{ $title}}
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
                        <form method="post" class="forms-sample" @if(empty($filterValue['id'])) action="{{ url('admin/add-edit-filter-value') }}" @else action="{{ url('admin/add-edit-filter-value/'.$filterValue['id']) }}" @endif enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="Filter_id">Select Filter</label>
                                <select class="select2single" name="filter_id" id="filter_id" required>
                                    <option value="" selected disabled>-- Select Section --</option>
                                    @foreach($filters as $filter)
                                    <option value="{{ $filter['id'] }}" @if(!empty($filterValue['filter_id']) && $filter['id']==$filterValue['filter_id']) selected @endif>{{ $filter['filter_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="filter_value">Filter Value</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="filter_value"
                                    name="filter_value"
                                    placeholder="Enter Filter Value"
                                    @if(!empty($filterValue['id'])) value="{{ $filterValue['filter_value'] }}" @else value="{{ old('filter_value') }}" @endif
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