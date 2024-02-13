<?php use App\Models\Product; ?>
@extends('front.layouts.layout')
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Order #{{ $orderDetails['id'] }} Details</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="{{ url('user/orders') }}">Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <table class="table table-striped table-borderless text-center">
                    <tr class="bg-danger text-light">
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
                                    <img style="width: 80px"
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
                <table class="table table-striped table-borderless text-center">
                    <tr class="bg-danger text-light">
                        <td colspan="2"><strong>Order Details</strong></td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])) }}</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td> {{ $orderDetails['order_status'] }} </td>
                    </tr>
                    <tr>
                        <th>Order Total</th>
                        <td> {{ $orderDetails['grand_total'] }} </td>
                    </tr>
                    <tr>
                        <th>Shipping Charges</th>
                        <td> {{ $orderDetails['shipping_charges'] }} </td>
                    </tr>

                    @if ($orderDetails['coupon_code'] != null)
                        <tr>
                            <th>Coupon Code</th>
                            <td> {{ $orderDetails['coupon_code'] }} </td>
                        </tr>
                        <tr>
                            <th>Coupon Amount</th>
                            <td> {{ $orderDetails['coupon_amount'] }} </td>
                        </tr>
                    @endif
                    <tr>
                        <th>Payment Method</th>
                        <td> {{ $orderDetails['payment_method'] }} </td>
                    </tr>
                    <tr class="bg-danger text-light">
                        <td colspan="2"><strong>Delivery Address</strong></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td> {{ $orderDetails['name'] }} </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td> {{ $orderDetails['address'] }} </td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td> {{ $orderDetails['city'] }} </td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td> {{ $orderDetails['state'] }} </td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td> {{ $orderDetails['country'] }} </td>
                    </tr>
                    <tr>
                        <th>Pincode</th>
                        <td> {{ $orderDetails['pincode'] }} </td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td> {{ $orderDetails['mobile'] }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection
