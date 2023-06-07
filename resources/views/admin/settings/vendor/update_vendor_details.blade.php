@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0 mx-auto">
                            <h3 class="font-weight-bold text-center">Update Vendor Details</h3>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            @if ($slug == 'personal')
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Update Personal Information</h4>
                                <hr>
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success: </strong> {{ Session::get('success_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: </strong> {{ Session::get('error_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Vendor Username/ Email</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_name">Name</label>
                                                <input type="text" class="form-control" id="vendor_name"
                                                    placeholder="Name" name="vendor_name"
                                                    value="{{ Auth::guard('admin')->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_address">Address</label>
                                                <input type="text" class="form-control" id="vendor_address"
                                                    placeholder="Vendor Address" name="vendor_address"
                                                    value="{{ $vendorDetails['address'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_city">City</label>
                                                <input type="text" class="form-control" id="vendor_city"
                                                    placeholder="Vendor city" name="vendor_city"
                                                    value="{{ $vendorDetails['city'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_state">State</label>
                                                <input type="text" class="form-control" id="vendor_state"
                                                    placeholder="Vendor state" name="vendor_state"
                                                    value="{{ $vendorDetails['state'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_country">Country</label>
                                                <input type="text" class="form-control" id="vendor_country"
                                                    placeholder="Vendor country" name="vendor_country"
                                                    value="{{ $vendorDetails['country'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_pincode">Pincode</label>
                                                <input type="text" class="form-control" id="vendor_pincode"
                                                    placeholder="Vendor pincode" name="vendor_pincode"
                                                    value="{{ $vendorDetails['pincode'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_mobile">Mobile</label>
                                                <input type="text" class="form-control" id="vendor_mobile"
                                                    placeholder="Mobile" name="vendor_mobile"
                                                    value="{{ Auth::guard('admin')->user()->mobile }}" minlength="11"
                                                    maxlength="14">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor_image">Vendor Photo</label>
                                                <input type="file" class="form-control" id="vendor_image"
                                                    name="vendor_image">
                                                @if (!empty(Auth::guard('admin')->user()->image))
                                                    <a href="{{ url('admin/photos/' . Auth::guard('admin')->user()->image) }}"
                                                        class="" target="_blank">View Image</a>
                                                    <input type="hidden" name="current_vendor_image"
                                                        value="{{ Auth::guard('admin')->user()->image }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($slug == 'business')
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Update Business Information</h4>
                                <hr>
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success: </strong> {{ Session::get('success_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: </strong> {{ Session::get('error_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Vendor Username/ Email</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_name">Shop Name</label>
                                                <input type="text" class="form-control" id="shop_name"
                                                    placeholder="Shop Name" name="shop_name"
                                                    value="{{ $vendorDetails['shop_name'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_address">Shop Address</label>
                                                <input type="text" class="form-control" id="shop_address"
                                                    placeholder="Shop Address" name="shop_address"
                                                    value="{{ $vendorDetails['shop_address'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_city">Shop City</label>
                                                <input type="text" class="form-control" id="shop_city"
                                                    placeholder="Shop city" name="shop_city"
                                                    value="{{ $vendorDetails['shop_city'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_state">Shop State</label>
                                                <input type="text" class="form-control" id="shop_state"
                                                    placeholder="Shop state" name="shop_state"
                                                    value="{{ $vendorDetails['shop_state'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_country">Shop Country</label>
                                                <input type="text" class="form-control" id="shop_country"
                                                    placeholder="Shop country" name="shop_country"
                                                    value="{{ $vendorDetails['shop_country'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_pincode">Shop Pincode</label>
                                                <input type="text" class="form-control" id="shop_pincode"
                                                    placeholder="Shop pincode" name="shop_pincode"
                                                    value="{{ $vendorDetails['shop_pincode'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_mobile">Shop Mobile</label>
                                                <input type="text" class="form-control" id="shop_mobile"
                                                    placeholder="Shop Mobile" name="shop_mobile"
                                                    value="{{ $vendorDetails['shop_mobile'] }}" minlength="11"
                                                    maxlength="14">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="shop_website">Shop Website</label>
                                                <input type="text" class="form-control" id="shop_website"
                                                    placeholder="Shop Website" name="shop_website"
                                                    value="{{ $vendorDetails['shop_website'] }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="business_license_number">Business License Number</label>
                                                <input type="text" class="form-control" id="business_license_number"
                                                    placeholder="Business License Number" name="business_license_number"
                                                    value="{{ $vendorDetails['business_license_number'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gst_number">GST Number</label>
                                                <input type="text" class="form-control" id="gst_number"
                                                    placeholder="GST Number" name="gst_number"
                                                    value="{{ $vendorDetails['gst_number'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pan_number">PAN Number</label>
                                                <input type="text" class="form-control" id="pan_number"
                                                    placeholder="PAN Number" name="pan_number"
                                                    value="{{ $vendorDetails['pan_number'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="address_proof">Address Proof</label>
                                            <select name="address_proof" id="address_proof" class="form-control">
                                                <option value="Passport" @if ($vendorDetails['address_proof'] == 'Passport') selected @endif>
                                                    Passport</option>
                                                <option value="NID" @if ($vendorDetails['address_proof'] == 'NID') selected @endif>
                                                    NID</option>
                                                <option value="Driving License"
                                                    @if ($vendorDetails['address_proof'] == 'Driving License') selected @endif>Driving License
                                                </option>
                                                <option value="PAN" @if ($vendorDetails['address_proof'] == 'PAN') selected @endif>
                                                    PAN</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_proof_image">Address Proof Image</label>
                                                <input type="file" class="form-control" id="address_proof_image"
                                                    name="address_proof_image">
                                                @if (!empty($vendorDetails['address_proof_image']))
                                                    <a href="{{ url('admin/photos/proofs/' . $vendorDetails['address_proof_image']) }}"
                                                        class="" target="_blank">View Image</a>
                                                    <input type="hidden" name="current_address_proof"
                                                        value="{{ $vendorDetails['address_proof_image'] }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($slug == 'bank')
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Update Vendor Details</h4>
                                <hr>
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success: </strong> {{ Session::get('success_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: </strong> {{ Session::get('error_message') }}

                                        <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="forms-sample" action="{{ url('admin/update-admin-details') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Admin Username/ Email</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Admin Type</label>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name"
                                            name="name" value="{{ Auth::guard('admin')->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile"
                                            name="mobile" value="{{ Auth::guard('admin')->user()->mobile }}"
                                            minlength="11" maxlength="14">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Admin Photo</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @if (!empty(Auth::guard('admin')->user()->image))
                                            <a href="{{ url('admin/photos/' . Auth::guard('admin')->user()->image) }}"
                                                class="" target="_blank">View Image</a>
                                            <input type="hidden" name="current_admin_image"
                                                value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
