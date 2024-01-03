@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Coupons</h4>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('admin/add-edit-coupon/') }}" class="btn btn-info">Add Coupon</a>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive pt-3">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                                        <strong>Success:</strong> {{ Session::get('success_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table class="table table-bordered table-striped" id="coupon">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Coupon Code
                                            </th>
                                            <th>
                                                Coupon Type
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Expiry Date
                                            </th>
                                            <th>Status</th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>
                                                    {{ $coupon['id'] }}
                                                </td>
                                                <td>
                                                    {{ $coupon['coupon_code'] }}
                                                </td>
                                                <td>
                                                    {{ $coupon['coupon_type'] }}
                                                </td>
                                                <td>
                                                    {{ $coupon['amount'] }}
                                                    @if ($coupon['amount_type'] == 'Percentage')
                                                        %
                                                    @else
                                                        BDT
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $coupon['expiry_date'] }}
                                                </td>
                                                <td>
                                                    @if ($coupon['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateCouponStatus"
                                                            id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($coupon['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateCouponStatus"
                                                            id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-coupon/' . $coupon['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="coupon"
                                                        moduleid="{{ $coupon['id'] }}">
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
