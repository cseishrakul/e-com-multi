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
                                    <h4 class="card-title">Home Page Banners</h4>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('admin/add-edit-banner/') }}" class="btn btn-info">Add Banner</a>
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
                                <table class="table table-bordered table-striped" id="banner">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Type
                                            </th>
                                            <th>
                                                Link
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Alt
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
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>
                                                    {{ $banner['id'] }}
                                                </td>
                                                <td>
                                                    <img src="{{asset('admin/photos/banner_images/'.$banner['image'])}}" alt="" class="">
                                                </td>
                                                <td>
                                                    {{ $banner['type'] }}
                                                </td>
                                                <td>
                                                    {{ $banner['link'] }}
                                                </td>
                                                <td>
                                                    {{ $banner['title'] }}
                                                </td>
                                                <td>
                                                    {{ $banner['alt'] }}
                                                </td>
                                                <td>
                                                    @if ($banner['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateBannerStatus"
                                                            id="banner-{{ $banner['id'] }}"
                                                            banner_id="{{ $banner['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($banner['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateBannerStatus"
                                                            id="banner-{{ $banner['id'] }}"
                                                            banner_id="{{ $banner['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-banner/' . $banner['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="banner"
                                                        moduleid="{{ $banner['id'] }}">
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
