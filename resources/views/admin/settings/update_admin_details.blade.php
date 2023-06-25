@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Settings</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Update Admin Details</h4>
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
                            <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Admin Username/ Email</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Admin Type</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                        name="name" value="{{ Auth::guard('admin')->user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile"
                                        name="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" minlength="11"
                                        maxlength="14">
                                </div>
                                <div class="form-group">
                                    <label for="image">Admin Photo</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a href="{{url('admin/photos/'.Auth::guard('admin')->user()->image)}}" class="" target="_blank">View Image</a>
                                        <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light mr-2">Cancel</button>
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
