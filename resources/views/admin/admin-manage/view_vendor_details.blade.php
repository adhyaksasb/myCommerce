@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Details</h3>
                        <h6 class="font-weight-normal"><a href="{{ url('admin/admin-manage/') }}"> Admin Management</a> / Vendor Details</h6>
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
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vendor Information</h4>
                        <form method="post" class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label>Vendor Email</label>
                                <input
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['email'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">Vendor Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['name'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_mobile">Vendor Mobile</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['mobile'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Vendor Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['address'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_country">Vendor Country</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['country'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">Vendor State</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['state'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Vendor City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['city'] }}"
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="vendor_pin">Vendor PIN Code</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    value="{{ $vendorDetails['vendor_personal']['pincode'] }}"
                                    readonly
                                    />
                            </div>
                            @if(!empty($vendorDetails['image']) && file_exists('admin/images/photos/'.$vendorDetails['image']))
                            <div class="form-group">
                                <label for="vendor_image">Profile Photo</label>
                                    <br>
                                    <img style="width: 200px; height: 200px;" src="{{ url('admin/images/photos/'.$vendorDetails['image']) }}">
                            </div>
                            @else
                            <div class="form-group">
                                <label for="vendor_image">Profile Photo</label>
                                    <br>
                                    <img style="width: 200px; height: 200px;"  src="{{ asset('admin/images/photos/NO IMAGE.png') }}">
                            </div>
                            @endif
                            <hr>
                            <h4 class="card-title">Bank Information</h4>
                            <div class="form-group">
                                <label for="account_holder_name">Account Holder Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_bank']['account_holder_name']))
                                    value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="bank_code">Bank Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_bank']['bank_code']))
                                    value="{{ $vendorDetails['vendor_bank']['bank_code'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_bank']['bank_name']))
                                    value="{{ $vendorDetails['vendor_bank']['bank_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_bank']['account_number']))
                                    value="{{ $vendorDetails['vendor_bank']['account_number'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Business Information</h4>
                        <form method="post" class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" enctype="multipart/form-data">@csrf
                            <div class="form-group">
                                <label>Shop Email</label>
                                <input
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_email']))
                                    value="{{ $vendorDetails['vendor_business']['shop_email'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_name']))
                                    value="{{ $vendorDetails['vendor_business']['shop_name'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_mobile']))
                                    value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_address']))
                                    value="{{ $vendorDetails['vendor_business']['shop_address'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_country']))
                                    value="{{ $vendorDetails['vendor_business']['shop_country'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_state']))
                                    value="{{ $vendorDetails['vendor_business']['shop_state'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_city']))
                                    value="{{ $vendorDetails['vendor_business']['shop_city'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_pin">Shop PIN Code</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_pincode']))
                                    value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="shop_website">Shop Website</label>
                                <input
                                    type="url"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['shop_website']))
                                    value="{{ $vendorDetails['vendor_business']['shop_website'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="tax_id'">Business License Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['business_license_number']))
                                    value="{{ $vendorDetails['vendor_business']['business_license_number'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="tax_id'">Tax Identification Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['tax_id']))
                                    value="{{ $vendorDetails['vendor_business']['tax_id'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            <div class="form-group">
                                <label for="tax_id'">Address Proof Type</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    @if(isset($vendorDetails['vendor_business']['address_proof']))
                                    value="{{ $vendorDetails['vendor_business']['address_proof'] }}"
                                    @else
                                    value=""
                                    @endif
                                    readonly
                                    />
                            </div>
                            @if(!empty($vendorDetails['vendor_business']['address_proof_image']))
                            <div class="form-group">
                                <label for="address_proof_image">Address Proof Image</label>
                                    <br>
                                    <img style="width: 200px; height: 200px;" src="{{ url('admin/images/proofs/'.$vendorDetails['vendor_business']['address_proof_image']) }}">
                            </div>
                            @endif
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