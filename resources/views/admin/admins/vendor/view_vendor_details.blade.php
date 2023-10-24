@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0 mx-auto">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 class="font-weight-bold text-right">Vendor Details</h3>
                                </div>
                                <div class="col-md-5">
                                    <a href="{{url('admin/admins')}}" class="text-center">(Back to Admins)</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Personal Information</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Email</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['email'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_name">Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['name'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_address">Address</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_city">City</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['city'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_state">State</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['state'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_country">Country</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['country'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_pincode">Pincode</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['pincode'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile</label>
                                        <input type="text" class="form-control"
                                            value="{{ $vendorDetails['vendor_personal']['mobile'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (!empty($vendorDetails['image']))
                                        <div class="form-group">
                                            <label for="vendor_image">Vendor Photo</label>
                                            <br>
                                            <img src="{{ url('admin/photos/' . $vendorDetails['image']) }}" alt=""
                                                class="" style="width: 100px; height:100px">

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Business Information</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_name">Shop Name</label>
                                        <input type="text" class="form-control"
                                            @if(isset($vendorDetails['vendor_business']['shop_name'])) value="{{$vendorDetails['vendor_business']['shop_name']}}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_address">Shop Address</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_address'])) value="{{ $vendorDetails['vendor_business']['shop_address'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_city">Shop City</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_city'])) value="{{ $vendorDetails['vendor_business']['shop_city'] }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_state">Shop State</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_state'])) value="{{ $vendorDetails['vendor_business']['shop_state'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_country">Shop Country</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_country'])) value="{{ $vendorDetails['vendor_business']['shop_country'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_pincode">Shop Pincode</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_pincode'])) value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}" @endif readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_mobile">Shop Mobile</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_mobile'])) value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_website">Shop Website</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_website'])) value="{{ $vendorDetails['vendor_business']['shop_website'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Shop Email</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['shop_email'])) value="{{ $vendorDetails['vendor_business']['shop_email'] }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Business License Number</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['business_license_number'])) value="{{ $vendorDetails['vendor_business']['business_license_number'] }}" @endif
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">GST Number</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['gst_number'])) value="{{ $vendorDetails['vendor_business']['gst_number'] }}"  @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">PAN Number</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['pan_number']))  value="{{ $vendorDetails['vendor_business']['pan_number'] }}" @endif readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Address Proof</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_business'] ['address_proof'])) value="{{ $vendorDetails['vendor_business']['address_proof'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                        <div class="form-group">
                                            <label for="vendor_image">Address Proof Image</label>
                                            <br>
                                            <img src="{{ url('admin/photos/proofs/' . $vendorDetails['vendor_business']['address_proof_image']) }}"
                                                alt="" class="" style="width: 100px; height:100px">

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Bank Information</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_name">Account Holder Name</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_bank'] ['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_address">Bank Name</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_bank'] ['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_state">Account Number</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_bank'] ['account_number']))  value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_country">Bank IFSC Code</label>
                                        <input type="text" class="form-control"
                                        @if(isset($vendorDetails['vendor_bank'] ['bank_ifsc_code'])) value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" @endif readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
