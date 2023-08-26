<?php use App\Models\ProductsFilter; ?>

@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Filters Value</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('admin/filters/') }}" class="btn btn-info">View Filters</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('admin/add-edit-filter-value/') }}" class="btn btn-info">Add Filters Value</a>
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
                                <table class="table table-bordered table-striped" id="filter_value">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Filter ID
                                            </th>
                                            <th>
                                                Filter Name
                                            </th>
                                            <th>
                                                Filter Value
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
                                        @foreach ($filter_values as $filter)
                                            <tr>
                                                <td>
                                                    {{ $filter['id'] }}
                                                </td>
                                                <td>
                                                    {{ $filter['filter_id'] }}
                                                </td>
                                                <td>
                                                    <?php
                                                        echo $getFilterName = ProductsFilter::getFilterName($filter['filter_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    {{ $filter['filter_value'] }}
                                                </td>
                                                <td>
                                                    @if ($filter['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateFilterValueStatus"
                                                            id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($filter['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateFilterValueStatus"
                                                            id="filter-{{ $filter['id'] }}" filter_id="{{ $filter['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-brand/' . $filter['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="filter"
                                                        moduleid="{{ $filter['id'] }}">
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
