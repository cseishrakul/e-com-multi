@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Attributes</h3>
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
                            <h4 class="card-title text-center">Add Attributes</h4>
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
                            <form class="forms-sample" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}"
                                method="POST">
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
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="text" name="size[]" class=""
                                                            placeholder="Size" required />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="sku[]" class=""
                                                            placeholder="SKU" required />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="price[]" class=""
                                                            placeholder="Price" required />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="stock[]" class=""
                                                            placeholder="Stock" required />
                                                    </div>
                                                    <div class="col-md-2">

                                                    </div>
                                                    <a href="javascript:void(0);" class="add_button"
                                                        title="Add Attibutes"><i class="mdi mdi-plus-box"
                                                            style="font-size: 25px;"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </form>
                            <br>
                            <hr>
                            <h4>Product Attibutes</h4><br>
                            <form method="POST" action="{{ url('admin/edit-attributes/' . $product['id']) }}">
                                @csrf
                                <table class="table table-bordered table-striped" id="products">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                SKU
                                            </th>
                                            <th>
                                                Size
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Stock
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product['attributes'] as $attribute)
                                            <input type="text" style="display: none;" name="attributeId[]" value="{{ $attribute['id'] }}">
                                            <tr>
                                                <td>
                                                    {{ $attribute['id'] }}
                                                </td>
                                                <td>
                                                    {{ $attribute['sku'] }}
                                                </td>
                                                <td>
                                                    {{ $attribute['size'] }}
                                                </td>
                                                <td>
                                                    <input type="number" name="price[]"
                                                        value="{{ $attribute['price'] }}" required style="width:70px;">
                                                </td>
                                                <td>
                                                    <input type="number" name="stock[]"
                                                        value="{{ $attribute['stock'] }}" required style="width:70px;">
                                                </td>
                                                <td>
                                                    @if ($attribute['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateAttributeStatus"
                                                            id="attribute-{{ $attribute['id'] }}"
                                                            attribute_id="{{ $attribute['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($attribute['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateAttributeStatus"
                                                            id="attribute-{{ $attribute['id'] }}"
                                                            attribute_id="{{ $attribute['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary my-2" style="margin-left:400px;">Update
                                    Attibutes</button>
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
