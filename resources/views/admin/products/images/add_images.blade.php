@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Images</h3>
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
                            <h4 class="card-title text-center">Add Images</h4>
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
                            <form class="forms-sample" action="{{ url('admin/add-images/' . $product['id']) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            &nbsp; &nbsp; {{ $product['product_name'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_code">Product Code</label>
                                            &nbsp; &nbsp; {{ $product['product_code'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_color">Product Color</label>
                                            &nbsp; &nbsp; {{ $product['product_color'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="product_price">Product Price</label>
                                            {{ $product['product_price'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="product_image">Product Image</label>
                                            @if (!empty($product['product_image']))
                                                <img style="width: 120px"
                                                    src="{{ url('admin/photos/product_images/large/' . $product['product_image']) }}"
                                                    class="" />
                                            @else
                                                <img style="width: 120px"
                                                    src="{{ url('admin/photos/product_images/small/no-image.png') }}"
                                                    class="" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="field_wrapper">
                                            <input type="file" name="images[]" multiple="" id="images"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </form>
                            <br>
                            <hr>
                            <h4>Product Images</h4><br>
                            <table class="table table-bordered table-striped" id="products">
                                <thead class="">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product['images'] as $image)
                                        <tr>
                                            <td>
                                                {{ $image['id'] }}
                                            </td>
                                            <td>
                                                <img style=""
                                                    src="{{ asset('admin/photos/product_images/small/' . $image['image']) }}"
                                                    alt="" class="">
                                            </td>
                                            <td>
                                                @if ($image['status'] == '1')
                                                    <a href="javascript:void(0)" class="updateImageStatus"
                                                        id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}">
                                                        <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                            status="Active"></i>
                                                    </a>
                                                @elseif($image['status'] == '0')
                                                    <a href="javascript:void(0)" class="updateImageStatus"
                                                        id="image-{{ $image['id'] }}" image_id="{{ $image['id'] }}">
                                                        <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                            status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="confirmDelete" module="image"
                                                    moduleid="{{ $image['id'] }}">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->

        @include('admin.layout.footer')
    </div>
@endsection
