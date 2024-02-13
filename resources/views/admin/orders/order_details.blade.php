<?php use App\Models\Product; ?>
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
                                    <h3 class="font-weight-bold text-right">Order Details</h3>
                                </div>
                                <div class="col-md-5">
                                    <a href="{{ url('admin/orders') }}" class="text-center">(Back to Orders)</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="font-weight: bold">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Order Details</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order ID:</b></label></div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> #{{ $orderDetails['id'] }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="exampleInputUsername1"><b>Order Date:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for="">
                                            {{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order Status:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['order_status'] }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Order Total:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['grand_total'] }} Tk.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6"><label for="exampleInputUsername1"><b>Shipping
                                                Charges:</b></label></div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['shipping_charges'] }} Tk.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($orderDetails['coupon_code']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-6"> <label for="exampleInputUsername1"><b>Coupon
                                                    Code:</b></label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label for=""> {{ $orderDetails['coupon_code'] }} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-6"><label for="exampleInputUsername1"><b>Coupon
                                                    Amount:</b></label>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <label for=""> {{ $orderDetails['coupon_amount'] }} Tk.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6"><label for="exampleInputUsername1"><b>Payment Method:</b></label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['payment_method'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputUsername1"><b>Payment Gateway:</b></label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <label for=""> {{ $orderDetails['payment_gateway'] }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Customer Details</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Name:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Mobile:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['mobile'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Email:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $userDetails['email'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($userDetails['address']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Address:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['address'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['city']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>City:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['city'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['state']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>State:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['state'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['country']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Country:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['country'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($userDetails['pincode']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Pincode:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $userDetails['pincode'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Delivery Address</h4>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Name:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['name'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-5"><label for="exampleInputUsername1"><b>Mobile:</b></label>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <label for=""> {{ $orderDetails['mobile'] }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($orderDetails['address']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Address:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['address'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['city']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>City:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['city'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['state']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>State:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['state'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['country']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Country:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['country'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($orderDetails['pincode']))
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-md-5"><label for="exampleInputUsername1"><b>Pincode:</b></label>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            <label for=""> {{ $orderDetails['pincode'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Update Order Status</h4>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-borderless text-center">
                        <tr class="bg-dark text-light">
                            <th>Product Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Qty</th>
                        </tr>
                        @foreach ($orderDetails['orders_products'] as $product)
                            <tr>
                                <td>
                                    @php
                                        $getProductImage = Product::getProductImage($product['product_id']);
                                    @endphp
                                    <a href="{{ url('product/' . $product['product_id']) }}" target="_blank" class="">
                                        <img style="width: 100px;height:100px"
                                            src="{{ asset('admin/photos/product_images/small/' . $getProductImage) }}"
                                            alt="">
                                    </a>
                                </td>
                                <td> {{ $product['product_code'] }} </td>
                                <td> {{ $product['product_name'] }} </td>
                                <td> {{ $product['product_size'] }} </td>
                                <td> {{ $product['product_color'] }} </td>
                                <td> {{ $product['product_qty'] }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
