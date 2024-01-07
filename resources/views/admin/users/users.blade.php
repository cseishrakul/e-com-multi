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
                                    <h4 class="card-title">Users</h4>

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
                                <table class="table table-bordered table-striped" id="users">
                                    <thead class="">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Address
                                            </th>
                                            <th>
                                                City
                                            </th>
                                            <th>
                                                State
                                            </th>
                                            <th>
                                                Country
                                            </th>
                                            <th>
                                                Pincode
                                            </th>
                                            <th>
                                                Mobile
                                            </th>
                                            <th>
                                                Email
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
                                        @foreach ($users as $user)


                                            <tr>
                                                <td>
                                                    {{ $user['id'] }}
                                                </td>
                                                <td>
                                                    {{ $user['name'] }}
                                                </td>
                                                <td>
                                                    {{$user['address']}}
                                                </td>
                                                <td>
                                                    {{$user['city']}}
                                                </td>
                                                <td>
                                                    {{ $user['state'] }}
                                                </td>
                                                <td>
                                                    {{ $user['country'] }}
                                                </td>
                                                <td>
                                                    {{ $user['pincode'] }}
                                                </td>
                                                <td>
                                                    {{ $user['mobile'] }}
                                                </td>
                                                <td>
                                                    {{ $user['email'] }}
                                                </td>
                                                <td>
                                                    @if ($user['status'] == '1')
                                                        <a href="javascript:void(0)" class="updateUserStatus"
                                                            id="user-{{ $user['id'] }}"
                                                            user_id="{{ $user['id'] }}">
                                                            <i class="mdi mdi-bookmark-check" style="font-size: 25px;"
                                                                status="Active"></i>
                                                        </a>
                                                    @elseif($user['status'] == '0')
                                                        <a href="javascript:void(0)" class="updateUserStatus"
                                                            id="user-{{ $user['id'] }}"
                                                            user_id="{{ $user['id'] }}">
                                                            <i class="mdi mdi-bookmark-outline" style="font-size: 25px;"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/add-edit-user/' . $user['id']) }}"
                                                        class="">
                                                        <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                    </a>

                                                    <a href="javascript:void(0)" class="confirmDelete" module="user"
                                                        moduleid="{{ $user['id'] }}">
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
