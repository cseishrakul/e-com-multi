@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Add New / Edit Filter</h3>
                        </div>
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="text-right">
                                <a href="{{ url('admin/filters') }}" class="btn btn-info">All Filter</a>
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
                                @if (empty($filter['id'])) action="{{ url('admin/add-edit-filter') }}" @else action="{{ url('admin/add-edit-filter/' . $filter['id']) }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cat_ids">Select Category</label>
                                            <select name="cat_ids[]" id="cat_ids" class="form-control" style="color: black" multiple="">
                                                <option value="">Select</option>
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{ $section['name'] }}"></optgroup>
                                                    @foreach ($section['categories'] as $category)
                                                        <option @if (!empty($filter['category_id']) && $filter['category_id'] == $category['id']) selected @endif
                                                            value="{{ $category['id'] }}">&nbsp; &nbsp; --&nbsp;{{ $category['category_name'] }}</option>
                                                        @foreach ($category['subcategories'] as $subcategory)
                                                            <option @if (!empty($filter['category_id']) && $filter['category_id'] == $subcategory['id']) selected @endif
                                                                value="{{ $subcategory['id'] }}"> &nbsp; &nbsp;&nbsp; &nbsp; --&nbsp;{{ $subcategory['category_name'] }} </option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="filter_name">filter Name</label>
                                            <input type="text" class="form-control" id="filter_name" name="filter_name"
                                                placeholder="Enter filter Name"
                                                @if (!empty($filter['filter_name'])) value="{{ $filter['filter_name'] }}" @else value="{{ old('filter_name') }}" @endif>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="filter_column">filter Column</label>
                                            <input type="text" class="form-control" id="filter_column"
                                                name="filter_column" placeholder="filter Column"
                                                @if (!empty($filter['filter_column'])) value="{{ $filter['filter_column'] }}" @else value="{{ old('filter_column') }}" @endif>
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
