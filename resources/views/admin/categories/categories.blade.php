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
                                    <h4 class="card-title">Categories</h4>

                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('admin/add-edit-category/') }}" class="btn btn-info">Add Category</a>
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
                                <table class="table table-bordered table-striped" id="categories">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Category
                                            </th>
                                            <th>
                                                Parent Category
                                            </th>
                                            <th>
                                                Section
                                            </th>
                                            <th>
                                                URL
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
                                        @foreach ($categories as $category)

                                        @if (isset($category['parentcategory']['category_name']) && !empty($category['parentcategory'] ['category_name']))
                                            <?php $parent_category = $category['parentcategory']['category_name'] ?>
                                        @else
                                            <?php $parent_category = "Root"; ?>
                                        @endif

                                            <tr>
                                                <td>
                                                    {{ $category['id'] }}
                                                </td>
                                                <td>
                                                    {{ $category['category_name'] }}
                                                </td>
                                                <td>
                                                    {{ $parent_category }}
                                                </td>
                                                <td>
                                                    {{ $category['section']['name'] }}
                                                </td>
                                                <td>
                                                    {{ $category['url'] }}
                                                </td>
                                                <td>
                                                    @if ($category['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateCategoryStatus"
                                                            id="category-{{ $category['id'] }}"
                                                            category_id="{{ $category['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($category['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateCategoryStatus"
                                                            id="category-{{ $category['id'] }}"
                                                            category_id="{{ $category['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-category/' . $category['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="section"
                                                        moduleid="{{ $category['id'] }}">
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
