<?php use App\Models\Product; ?>
@extends('front.layouts.layout')
@section('content')
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">
            @foreach ($sliderBanners as $sliderBanner)
                <div class="bg-image">
                    <div class="slide-content">
                        <h1>
                            <a @if (!empty($sliderBanner['link'])) href="{{ url($sliderBanner['link']) }}" @else href="javascript::" @endif
                                class="">
                                <img title="{{ $sliderBanner['title'] }}" alt="{{ $sliderBanner['title'] }}"
                                    src="{{ asset('admin/photos/banner_images/' . $sliderBanner['image']) }}" />
                            </a>
                        </h1>
                        <h2>{{ $sliderBanner['title'] }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Main-Slider /- -->
    <!-- Banner-Layer -->
    @if (isset($fixBanners[0]['image']))
        <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[0]['link']) }}"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('admin/photos/banner_images/' . $fixBanners[0]['image']) }}"
                            alt="{{ $fixBanners[0]['alt'] }}" title="{{ $fixBanners[0]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Banner-Layer /- -->
    <!-- Top Collection -->
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">TOP COLLECTION</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="men-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($newProducts as $product)
                                        <?php $product_image_path = 'admin/photos/product_images/small/' . $product['product_image']; ?>

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ url('product/' . $product['id']) }}">
                                                    @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                            alt="Product">
                                                    @else
                                                        <img class="img-fluid"
                                                            src="{{ asset('admin') }}/photos/product_images/small/no-image.png"
                                                            alt="Product">
                                                    @endif

                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>
                                                <?php $getDiscountPrice = Product::discountPrice($product['id']); ?>

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }} Tk.
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $product['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $product['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane show fade" id="men-best-selling-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($bestSellers as $bestSeller)
                                        <?php $product_image_path = 'admin/photos/product_images/small/' . $bestSeller['product_image']; ?>

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ url('product/' . $bestSeller['id']) }}">
                                                    @if (!empty($bestSeller['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                            alt="Product">
                                                    @else
                                                        <img class="img-fluid"
                                                            src="{{ asset('admin') }}/photos/product_images/small/no-image.png"
                                                            alt="Product">
                                                    @endif

                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="{{ url('product/' . $bestSeller['id']) }}">{{ $bestSeller['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ url('product/' . $bestSeller['id']) }}">{{ $bestSeller['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>
                                                <?php $getDiscountPrice = Product::discountPrice($bestSeller['id']); ?>

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }} Tk.
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $bestSeller['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $bestSeller['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discounted-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($discountedProducts as $discountedProduct)
                                        <?php $product_image_path = 'admin/photos/product_images/small/' . $discountedProduct['product_image']; ?>

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ url('product/' . $discountedProduct['id']) }}">
                                                    @if (!empty($discountedProduct['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                            alt="Product">
                                                    @else
                                                        <img class="img-fluid"
                                                            src="{{ asset('admin') }}/photos/product_images/small/no-image.png"
                                                            alt="Product">
                                                    @endif

                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="{{ url('product/' . $discountedProduct['id']) }}">{{ $discountedProduct['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ url('product/' . $discountedProduct['id']) }}">{{ $discountedProduct['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>
                                                <?php $getDiscountPrice = Product::discountPrice($discountedProduct['id']); ?>

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }} Tk.
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $discountedProduct['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $discountedProduct['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="men-featured-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($featuredProducts as $featuredProduct)
                                        <?php $product_image_path = 'admin/photos/product_images/small/' . $featuredProduct['product_image']; ?>

                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ url('product/' . $featuredProduct['id']) }}">
                                                    @if (!empty($featuredProduct['product_image']) && file_exists($product_image_path))
                                                        <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                            alt="Product">
                                                    @else
                                                        <img class="img-fluid"
                                                            src="{{ asset('admin') }}/photos/product_images/small/no-image.png"
                                                            alt="Product">
                                                    @endif

                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="{{ url('product/' . $featuredProduct['id']) }}">{{ $featuredProduct['product_code'] }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ url('product/' . $featuredProduct['id']) }}">{{ $featuredProduct['product_name'] }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                            <span style='width:0'></span>
                                                        </div>
                                                        <span>(0)</span>
                                                    </div>
                                                </div>
                                                <?php $getDiscountPrice = Product::discountPrice($featuredProduct['id']); ?>

                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $getDiscountPrice }} Tk.
                                                        </div>
                                                        <div class="item-old-price">
                                                            {{ $featuredProduct['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                            {{ $featuredProduct['product_price'] }} Tk.
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Collection /- -->
    <!-- Banner-Layer -->
    @if (isset($fixBanners[1]['image']))
        <div class="banner-layer">
            <div class="container">
                <div class="image-banner">
                    <a target="_blank" rel="nofollow" href="{{ url($fixBanners[1]['link']) }}"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('admin/photos/banner_images/' . $fixBanners[1]['image']) }}"
                            alt="{{ $fixBanners[1]['alt'] }}" title="{{ $fixBanners[1]['title'] }}">
                    </a>
                </div>
            </div>
        </div>
    @endif
    <!-- Banner-Layer /- -->
    <!-- Site-Priorities -->
    <section class="app-priority">
        <div class="container">
            <div class="priority-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-star"></i>
                            </div>
                            <h2>
                                Great Value
                            </h2>
                            <p>We offer competitive prices on our 100 million plus product range</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-cash"></i>
                            </div>
                            <h2>
                                Shop with Confidence
                            </h2>
                            <p>Our Protection covers your purchase from click to delivery</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-ios-card"></i>
                            </div>
                            <h2>
                                Safe Payment
                            </h2>
                            <p>Pay with the world’s most popular and secure payment methods</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-contacts"></i>
                            </div>
                            <h2>
                                24/7 Help Center
                            </h2>
                            <p>Round-the-clock assistance for a smooth shopping experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="footer">
        <div class="container">
            <!-- Outer-Footer -->
            <div class="outer-footer-wrapper u-s-p-y-80">
                <h6>
                    For special offers and other discount information
                </h6>
                <h1>
                    Subscribe to our Newsletter
                </h1>
                <p>
                    Subscribe to the mailing list to receive updates on promotions, new arrivals, discount and coupons.
                </p>
                <form class="newsletter-form">
                    <label class="sr-only" for="newsletter-field">Enter your Email</label>
                    <input type="text" id="newsletter-field" placeholder="Your Email Address">
                    <button type="submit" class="button">SUBMIT</button>
                </form>
            </div>
            <!-- Outer-Footer /- -->
            <!-- Mid-Footer -->
            <div class="mid-footer-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>COMPANY</h6>
                            <ul>
                                <li>
                                    <a href="about.html">About Us</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact Us</a>
                                </li>
                                <li>
                                    <a href="faq.html">FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>COLLECTION</h6>
                            <ul>
                                <li>
                                    <a href="cart.html">Men Clothing</a>
                                </li>
                                <li>
                                    <a href="checkout.html">Women Clothing</a>
                                </li>
                                <li>
                                    <a href="account.html">Kids Clothing</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>ACCOUNT</h6>
                            <ul>
                                <li>
                                    <a href="shop-v1-root-category.html">My Account</a>
                                </li>
                                <li>
                                    <a href="shop-v1-root-category.html">My Profile</a>
                                </li>
                                <li>
                                    <a href="listing.html">My Orders</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>Contact</h6>
                            <ul>
                                <li>
                                    <i class="fas fa-location-arrow u-s-m-r-9"></i>
                                    <span>Stack Developers Youtube Channel</span>
                                </li>
                                <li>
                                    <a href="tel:+111-222-333">
                                        <i class="fas fa-phone u-s-m-r-9"></i>
                                        <span>+111-222-333</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:info@sitemakers.in">
                                        <i class="fas fa-envelope u-s-m-r-9"></i>
                                        <span>
                                            info@sitemakers.in</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mid-Footer /- -->
        </div>
    </section>
@endsection
