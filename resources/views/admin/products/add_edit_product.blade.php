@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Add New / Edit Product</h3>
                        </div>
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="text-right">
                                <a href="{{ url('admin/products') }}" class="btn btn-info">All Products</a>
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
                                @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Select Category</label>
                                            <select name="category_id" id="category_id" class="form-control"
                                                style="color:black">
                                                <option value="">Select</option>
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                                    @foreach ($section['categories'] as $category)
                                                        <option @if (!empty($product['category_id'] == $category['id'])) selected @endif
                                                            value="{{ $category['id'] }}">&nbsp; &nbsp; --
                                                            &nbsp;{{ $category['category_name'] }}</option>
                                                        @foreach ($category['subcategories'] as $subcategories)
                                                            <option @if (!empty($product['category_id'] == $subcategories['id'])) selected @endif
                                                                value="{{ $subcategories['id'] }}"> &nbsp;
                                                                &nbsp;&nbsp; &nbsp; --&nbsp;
                                                                &nbsp;{{ $subcategories['category_name'] }} </option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="loadFilters">
                                            @include('admin.filters.category_filter')
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="brand_id">Select Brand</label>
                                            <select name="brand_id" id="brand_id" class="form-control" style="color:black">
                                                <option value="">Select</option>
                                                @foreach ($brands as $brand)
                                                    <option @if (!empty($product['brand_id'] == $brand['id'])) selected @endif
                                                        value="{{ $brand['id'] }}"> {{ $brand['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name"
                                                placeholder="Enter Product Name"
                                                @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" class="form-control" id="product_code" name="product_code"
                                                placeholder="Product Code"
                                                @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_color">Product Color</label>
                                            <input type="text" class="form-control" id=lor" name="product_color"
                                                placeholder="Product Color"
                                                @if (!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_weight">Product Weight </label>
                                            <input type="text" class="form-control" id="product_weight"
                                                name="product_weight" placeholder="Product Weight"
                                                @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="group_code">Group Code </label>
                                            <input type="text" class="form-control" id="group_code"
                                                name="group_code" placeholder="Group Code"
                                                @if (!empty($product['group_code'])) value="{{ $product['group_code'] }}" @else value="{{ old('group_code') }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Product Description</label>
                                            <textarea name="description" id="description" rows="3" class="form-control"> {{ $product['description'] }} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_price">Product Price</label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price" placeholder="Product Price"
                                                @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_discount">Product Discount (%)</label>
                                            <input type="text" class="form-control" id="product_discount"
                                                name="product_discount" placeholder="Product Discount"
                                                @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_keywords"
                                                name="meta_keywords" placeholder="Meta Keywords"
                                                @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                                placeholder="Meta Title"
                                                @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description"
                                                name="meta_description" placeholder="Meta Description"
                                                @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_image">Product Image (Recommend Size: 1000 x 1000 )</label>
                                            <input type="file" name="product_image" id="product_image"
                                                class="form-control">

                                            @if (!empty($product['product_image']))
                                                <a target="_blank"
                                                    href="{{ url('admin/photos/product_images/large/' . $product['product_image']) }}"
                                                    class="">View Image</a>&nbsp;|&nbsp;
                                                <a href="javascript:void(0)" class="confirmDelete" module="product-image"
                                                    moduleid="{{ $product['id'] }}">Delete Image</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_video">Product Video (Recommend Size: Less theb 2M
                                                )</label>
                                            <input type="file" name="product_video" id="product_video"
                                                class="form-control">

                                            @if (!empty($product['product_video']))
                                                <a target="_blank"
                                                    href="{{ url('admin/videos/product_video/' . $product['product_video']) }}"
                                                    class="">View Video</a>&nbsp;|&nbsp;
                                                <a href="javascript:void(0)" class="confirmDelete" module="product-video"
                                                    moduleid="{{ $product['id'] }}">Delete Video</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-5">
                                            <label for="is_featured" style="font-size: 15px;font-weight:bold">Featured
                                                Item</label>
                                            <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                                                class="" @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mt-5">
                                            <label for="is_bestseller" style="font-size: 15px;font-weight:bold">Best Seller Item</label>
                                            <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes"
                                                class="" @if (!empty($product['is_bestseller']) && $product['is_bestseller'] == 'Yes') checked @endif>
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
