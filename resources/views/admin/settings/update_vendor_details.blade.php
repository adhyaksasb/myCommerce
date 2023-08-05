@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Details</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($slug == "personal")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Personal Details</h4>
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
                        <form method="post" class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    class="form-control"
                                    value="{{ Auth::guard('admin')->user()->email }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for=vendor_name">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="vendor_name"
                                    name="vendor_name"
                                    placeholder="Enter Your Name"
                                    value="{{ Auth::guard('admin')->user()->name }}"
                                    />
                            </div>
                            <div class="form-group">
                                <label for=vendor_mobile">Mobile</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="vendor_mobile"
                                    name="vendor_mobile"
                                    placeholder="Enter Mobile Number (Max 15 Digits)"
                                    value="{{ Auth::guard('admin')->user()->mobile }}"
                                    maxlength="15"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="vendor_address"
                                    name="vendor_address"
                                    placeholder="Enter Your Address"
                                    value="{{ $vendorDetails['address'] }}"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_country">Country</label>
                                <select class="select2single" name="vendor_country" id="vendor_country" style="color: black">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country['country_name'] }}" @if($country['country_name']==$vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">State</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="vendor_state"
                                    name="vendor_state"
                                    placeholder="Enter Your State"
                                    value="{{ $vendorDetails['state'] }}"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="vendor_city"
                                    name="vendor_city"
                                    placeholder="Enter Your City"
                                    value="{{ $vendorDetails['city'] }}"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_pin">PIN Code</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="vendor_pin"
                                    name="vendor_pin"
                                    placeholder="Enter Your PIN Code"
                                    value="{{ $vendorDetails['pincode'] }}"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="image">Vendor Image</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="vendor_image"
                                  name="vendor_image"
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
                                @if(!empty(Auth::guard('admin')->user()->image))
                                    <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                                    <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif($slug == "business")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Business Details</h4>
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
                        <form method="post" class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label>Shop Email</label>
                                <input
                                    class="form-control"
                                    id="shop_email"
                                    name="shop_email"
                                    placeholder="Enter Shop Email"
                                    @if(isset($vendorDetails['shop_email']))
                                    value="{{ $vendorDetails['shop_email'] }}"
                                    @else
                                    value = ""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="shop_name"
                                    name="shop_name"
                                    placeholder="Enter Shop Name"
                                    @if(isset($vendorDetails['shop_name']))
                                    value="{{ $vendorDetails['shop_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="shop_mobile"
                                    name="shop_mobile"
                                    placeholder="Enter Shop Mobile Number (Max 15 Digits)"
                                    @if(isset($vendorDetails['shop_mobile']))
                                    value="{{ $vendorDetails['shop_mobile'] }}"
                                    @else
                                    value=""
                                    @endif
                                    maxlength="15"
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="shop_address"
                                    name="shop_address"
                                    placeholder="Enter Shop Address"
                                    @if(isset($vendorDetails['shop_address']))
                                    value="{{ $vendorDetails['shop_address'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Website</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="shop_website"
                                    name="shop_website"
                                    placeholder="Enter Shop Website"
                                    @if(isset($vendorDetails['shop_website']))
                                    value="{{ $vendorDetails['shop_website'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <select class="select2single" name="shop_country" id="shop_country">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country['country_name'] }}" @if(isset($vendorDetails['shop_country']) && $country['country_name']==$vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="shop_state"
                                    name="shop_state"
                                    placeholder="Enter Shop State"
                                    @if(isset($vendorDetails['shop_state']))
                                    value="{{ $vendorDetails['shop_state'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="shop_city"
                                    name="shop_city"
                                    placeholder="Enter Shop City"
                                    @if(isset($vendorDetails['shop_city']))
                                    value="{{ $vendorDetails['shop_city'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_pin">Shop PIN Code</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="shop_pin"
                                    name="shop_pin"
                                    placeholder="Enter Shop PIN Code"
                                    @if(isset($vendorDetails['shop_pincode']))
                                    value="{{ $vendorDetails['shop_pincode'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="business_license">Shop License Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="business_license"
                                    name="business_license"
                                    placeholder="Enter Business License Number"
                                    @if(isset($vendorDetails['business_license_number']))
                                    value="{{ $vendorDetails['business_license_number'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="tax_id">Tax Identification Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="tax_id"
                                    name="tax_id"
                                    placeholder="Enter Tax Identification Number"
                                    @if(isset($vendorDetails['tax_id']))
                                    value="{{ $vendorDetails['tax_id'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="address_proof">Address Proof</label>
                                <select class="form-control" name="address_proof" id="address_proof" style="color: black" required>
                                    <option value="" selected disabled>Select Address Proof</option>
                                    <option value="Utility Bill" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Utility Bill") selected @endif>Utility Bill</option>
                                    <option value="Property Tax Receipt" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Property Tax Receipt") selected @endif>Property Tax Receipt</option>
                                    <option value="Registration Agreement" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Registration Agreement") selected @endif>Registration Agreement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Address Proof Image</label>
                                <input
                                  type="file"
                                  class="file-upload-default"
                                  id="address_proof_image"
                                  name="address_proof_image"
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
                                @if(!empty($vendorDetails['address_proof_image']))
                                    <a target="_blank" href="{{ url('admin/images/proofs/'. $vendorDetails['address_proof_image']) }}">View Image</a>
                                    <input type="hidden" name="current_address_image" value="{{ $vendorDetails['address_proof_image'] }}">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif($slug == "bank")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Bank Information</h4>
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
                        <form method="post" class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label for="account_holder_name">Account Holder Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account_holder_name"
                                    name="account_holder_name"
                                    placeholder="Enter Shop Name"
                                    @if(isset($vendorDetails['account_holder_name']))
                                        value="{{ $vendorDetails['account_holder_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="bank_code">Bank Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_code"
                                    name="bank_code"
                                    placeholder="Enter Bank Code"
                                    @if(isset($vendorDetails['bank_code']))
                                    value="{{ $vendorDetails['bank_code'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="bank_name"
                                    name="bank_name"
                                    placeholder="Enter bank_name"
                                    @if(isset($vendorDetails['bank_name']))
                                    value="{{ $vendorDetails['bank_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account_number"
                                    name="account_number"
                                    placeholder="Enter Shop City"
                                    @if(isset($vendorDetails['account_number']))
                                    value="{{ $vendorDetails['account_number'] }}"
                                    @else
                                    value=""
                                    @endif
                                    />
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                            Submit
                            </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer');
    <!-- partial -->
</div>
@endsection