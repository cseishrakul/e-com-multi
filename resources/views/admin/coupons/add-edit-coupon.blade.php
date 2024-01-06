@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Add New / Edit Coupon</h3>
                        </div>
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="text-right">
                                <a href="{{ url('admin/coupons') }}" class="btn btn-info">All coupons</a>
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $title }}</h4>
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
                            <form class="forms-sample"
                                @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/' . $coupon['id']) }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (empty($coupon['coupon_code']))
                                            <div class="form-group">
                                                <label for="coupon_option"><b>Coupon Option</b></label>
                                                <span>
                                                    <input type="radio" name="coupon_option" value="Automatic"
                                                        checked="" id="automaticCoupon">&nbsp; Automatic &nbsp; &nbsp;

                                                    <input type="radio" name="coupon_option" value="Manual"
                                                        id="manualCoupon">&nbsp; Manual &nbsp; &nbsp;
                                                </span>
                                            </div>
                                        @else
                                            <input type="hidden" name="coupon_option"
                                                value="{{ $coupon['coupon_option'] }}">
                                            <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                                            <div class="form-group">
                                                <label for="coupon_code"><b>Coupon Code:</b></label>
                                                <span>{{ $coupon['coupon_code'] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group" style="display: none;" id="couponField">
                                            <label for="coupon_code"><b>Coupon Code</b></label>
                                            <input type="text" name="coupon_code" class="form-control"
                                                placeholder="Enter your coupon code">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount_type"><b>Amount Type</b></label>
                                            <span>
                                                <input type="radio" name="amount_type" value="Percentage"
                                                    @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Percentage') checked="" @endif>&nbsp; Percentage
                                                &nbsp; (In %) &nbsp;

                                                <input type="radio" name="amount_type" value="Fixed"
                                                    @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Fixed') checked="" @endif>&nbsp; Fixed &nbsp;
                                                &nbsp;(In BDT or USD)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="coupon_type"><b>Coupon Type</b></label>
                                            <span>
                                                <input type="radio" name="coupon_type" value="Multiple Times"
                                                    @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Multiple Times') checked="" @endif>&nbsp; Multiple
                                                &nbsp; &nbsp;

                                                <input type="radio" name="coupon_type" value="Single Time"
                                                    @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Single Time') checked="" @endif>&nbsp; Single &nbsp;
                                                &nbsp;
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount"><b>Amount</b></label>
                                            <input type="text" class="form-control" name="amount"
                                                placeholder="Enter Amount"
                                                @if (isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @else value="{{old('amount')}}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categories"><b>Select Category</b></label>
                                            <select name="categories[]" class="form-control" style="color:black"
                                                multiple="">
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                                    @foreach ($section['categories'] as $category)
                                                        <option value="{{ $category['id'] }}" @if (in_array($category['id'],$selCats)) selected=""@endif>&nbsp; &nbsp; --
                                                            &nbsp;{{ $category['category_name'] }}</option>
                                                        @foreach ($category['subcategories'] as $subcategories)
                                                            <option value="{{ $subcategories['id'] }}"@if (in_array($subcategories['id'],$selCats)) selected=""@endif> &nbsp;
                                                                &nbsp;&nbsp; &nbsp; --&nbsp;
                                                                &nbsp;{{ $subcategories['category_name'] }} </option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brands"><b>Select Brand</b></label>
                                            <select name="brands[]" class="form-control" style="color:black"
                                                multiple="">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand['id'] }}"@if (in_array($brand['id'],$selBrands)) selected=""@endif> {{ $brand['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="users"><b>Select User</b></label>
                                            <select name="users[]" class="form-control" style="color:black"
                                                multiple="">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user['email'] }}"@if (in_array($user['email'],$selUsers)) selected=""@endif> {{ $user['email'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expiry_date"><b>Expiry Date</b></label>
                                            <input type="date" name="expiry_date" class="form-control"
                                                placeholder="Enter Expiry Date" @if (isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @else value="{{old('expiry_date')}}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
