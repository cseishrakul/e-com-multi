@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Add New / Edit Category</h3>
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
                                @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/' . $category['id']) }}" @endif
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" id="category_name"
                                                name="category_name" placeholder="Enter Category Name"
                                                @if (!empty($category['category_name'])) value="{{ $category['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="section_id">Select Section</label>
                                            <select name="section_id" id="section_id" class="form-control" style="color:black">
                                                <option value="">Select</option>
                                                @foreach ($getSections as $section)
                                                    <option value="{{ $section['id'] }}" @if(!empty($category['section_id']) && $category['section_id'] == $section['id']) selected @endif>{{ $section['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="appendCategoryLevel">
                                            @include('admin.categories.append_categories_level')
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_discount">Category Discount</label>
                                            <input type="text" class="form-control" id="category_discount"
                                                name="category_discount" placeholder="Category Discount"
                                                @if (!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="description">Category Description</label>
                                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <input type="text" class="form-control" id="meta_keywords"
                                                name="meta_keywords" placeholder="Meta Keywords"
                                                @if (!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                                placeholder="Meta Title"
                                                @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description"
                                                name="meta_description" placeholder="Meta Description"
                                                @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="url">Category URL</label>
                                            <input type="text" class="form-control" id="url" name="url"
                                                placeholder="Category URL"
                                                @if (!empty($category['url'])) value="{{ $category['url'] }}" @else value="{{ old('url') }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_image">Category Image</label>
                                            <input type="file" name="category_image" id="category_image"
                                                class="form-control">

                                            @if (!empty($category['category_image']))
                                                <a target="_blank" href="{{url('admin/photos/category_images/'.$category['category_image'])}}"  class="">View Image</a>&nbsp;|&nbsp;
                                                <a href="javascript:void(0)" class="confirmDelete" module="category-image" moduleid="{{$category['id']}}">Delete Image</a>
                                            @endif
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
