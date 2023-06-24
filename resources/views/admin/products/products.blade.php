@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Products</h4>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('admin/add-edit-product/') }}" class="btn btn-info">Add Products</a>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive mt-3">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table class="table table-striped table-bordered" id="products">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Color
                                            </th>
                                            <th>
                                                Code
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Category
                                            </th>
                                            <th>
                                                Section
                                            </th>
                                            <th>
                                                Added By
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
                                        @foreach ($products as $product)

                                            <tr>
                                                <td>
                                                    {{ $product['id'] }}
                                                </td>
                                                <td>
                                                    {{ $product['product_name'] }}
                                                </td>
                                                <td>
                                                    {{ $product['product_color'] }}
                                                </td>
                                                <td>
                                                    {{ $product['product_code'] }}
                                                </td>
                                                <td>
                                                    @if (!empty($product['product_image']))
                                                        <img style="" src="{{asset('admin/photos/product_images/small/'.$product['product_image'])}}" alt="" class="">
                                                    @else 
                                                    <img style="" src="{{asset('admin/photos/product_images/small/no-image.png')}}" alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $product['category']['category_name'] }}
                                                </td>
                                                <td>
                                                    {{ $product['section']['name'] }}
                                                </td>
                                                <td>
                                                    @if ($product['admin_type'] == 'vendor')
                                                        <a target="_blank" href="{{url('admin/view-vendor-details/'.$product['admin_id'])}}" class="">{{ ucfirst($product['admin_type'])}}</a>
                                                    @else
                                                        {{ucfirst($product['admin_type'])}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateProductStatus"
                                                            id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($product['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateProductStatus"
                                                            id="product-{{ $product['id'] }}"
                                                            product_id="{{ $product['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Edit Product" href="{{ url('admin/add-edit-product/' . $product['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a title="Add Attributes" href="{{ url('admin/add-edit-attributes/' . $product['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-plus-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a title="Add Multiple Images" href="{{ url('admin/add-images/' . $product['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-library-plus" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="product"
                                                        moduleid="{{ $product['id'] }}">
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        <!-- partial -->
    </div>
@endsection
