<?php use App\Models\Product; ?>
@extends('front.layouts.layout')
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Checkout</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="checkout.html">Checkout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-80">
        <div class="container">
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> <?php echo Session::get('error_message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <!-- First-Accordion -->

                        <!-- First-Accordion /- -->
                        <div class="row">
                            <!-- Billing-&-Shipping-Details -->
                            <div class="col-lg-7" id="deliveryAddresses">
                                @include('front.products.delivery_addresses');
                            </div>
                            <!-- Billing-&-Shipping-Details /- -->
                            <!-- Checkout -->
                            <div class="col-lg-5">
                                <h4 class="section-h4">Your Order</h4>
                                <div class="order-table">
                                    <table class="u-s-m-b-13">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            @foreach ($getCartItems as $item)
                                                <?php $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']); ?>
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('product/' . $item['product_id']) }}">
                                                            <img width="40"
                                                                src="{{ asset('admin/photos/product_images/small/' . $item['product']['product_image']) }}"
                                                                alt="Product">
                                                            <h6 class="order-h6 mt-4">{{ $item['product']['product_name'] }}
                                                                <br /> {{ $item['size'] }} /
                                                                {{ $item['product']['product_color'] }}
                                                            </h6>
                                                            <span class="order-span-quantity">x
                                                                {{ $item['quantity'] }}</span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h6 class="order-h6">
                                                            {{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}
                                                            Tk.
                                                        </h6>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_price = $total_price + $getDiscountAttributePrice['final_price'] * $item['quantity'];
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <h3 class="order-h3">Subtotal</h3>
                                                </td>
                                                <td>
                                                    <h3 class="order-h3">{{ $total_price }} TK.</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="order-h6">Shipping Charges</h3>
                                                </td>
                                                <td>
                                                    <h3 class="order-h6">0.00 Tk.</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="order-h6">Coupon Discount</h3>
                                                </td>
                                                <td>
                                                    <h3 class="order-h6">
                                                        @if (Session::has('couponAmount'))
                                                            {{ Session::get('couponAmount') }} Tk.
                                                        @else
                                                            0.00 Tk.
                                                        @endif
                                                    </h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3 class="order-h3">Grand Total</h3>
                                                </td>
                                                <td>
                                                    <h3 class="order-h3">{{ $total_price - Session::get('couponAmount') }}
                                                        Tk.
                                                    </h3>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="u-s-m-b-13">
                                        <input type="radio" class="radio-box" name="payment_gateway" value="COD"
                                            id="cash-on-delivery">
                                        <label class="label-text" for="cash-on-delivery">Cash on Delivery</label>
                                    </div>
                                    {{-- <div class="u-s-m-b-13">
                                        <input type="radio" class="radio-box" name="payment_gateway" value="Stripe"
                                            id="credit-card-stripe">
                                        <label class="label-text" for="credit-card-stripe">Credit Card (Stripe)</label>
                                    </div> --}}
                                    <div class="u-s-m-b-13">
                                        <input type="radio" class="radio-box" name="payment_gateway" value="Paypal"
                                            id="paypal">
                                        <label class="label-text" for="paypal">Paypal</label>
                                    </div>
                                    <div class="u-s-m-b-13">
                                        <input type="checkbox" class="check-box" id="accept" name="accept"
                                            value="Yes" title="Please agree to T&C">
                                        <label class="label-text no-color" for="accept">I’ve read and accept the
                                            <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                                        </label>
                                    </div>
                                    <button type="submit" class="button button-outline-secondary">Place Order</button>
                                </div>
                            </div>
                            <!-- Checkout /- -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout-Page /- -->

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>
@endsection
