@extends('front.layouts.layout');
@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Account</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="account.html">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    <strong>error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <!-- account -->
                <div class="col-lg-6">
                    <div class="account-wrapper">
                        <h2 class="account-h2 u-s-m-b-20 text-center" style="font-size: 30px">Update User Contact Details</h2> 
                        <hr>
                        <p id="account-error"></p>
                        <p id="account-success"></p>
                        <form id="accountForm" class="mt-4" action="javascript:;" method="POST">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="user-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input class="text-field" value="{{ Auth::user()->email }}" readonly disabled
                                    style="background-color: #e9e9e9;">
                                <p id="account-email"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="username">Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-name" name="name" class="text-field"
                                    value="{{ Auth::user()->name }}">
                                <p id="account-name"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="address">Address
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-address" name="address" class="text-field"
                                    value="{{ Auth::user()->address }}">
                                <p id="account-address"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="city">City
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-city" name="city" class="text-field"
                                    value="{{ Auth::user()->city }}">
                                <p id="account-city"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="state">State
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-state" name="state" class="text-field"
                                    value="{{ Auth::user()->state }}">
                                <p id="account-state"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="country">Country
                                    <span class="astk">*</span>
                                </label>
                                <select name="country" id="user-country" class="text-field" style="color:#495057;">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['country_name'] }}"
                                            @if ($country['country_name'] == Auth::user()->country) selected @endif>
                                            {{ $country['country_name'] }} </option>
                                    @endforeach
                                </select>
                                <p id="account-country"></p>
                            </div>

                            <div class="u-s-m-b-30">
                                <label for="pincode">Pincode
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-pincode" name="pincode" class="text-field"
                                    value="{{ Auth::user()->pincode }}">
                                <p id="account-pincode"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="mobile">Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="account-mobile" name="mobile" class="text-field"
                                    value="{{ Auth::user()->mobile }}">
                                <p id="account-mobile"></p>
                            </div>

                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Update Details</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- account /- -->
                <!-- Update Password -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-20 text-center" style="font-size:25px">Update Password</h2>
                        <hr>
                        <p id="password-success"></p>
                        <p id="password-error"></p>
                        <form id="passwordForm" class="mt-4" action="javascript:;" method="post">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="current-password">Current Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="current-password" name="current_password" class="text-field" placeholder="Your current password">
                                <p id="password-current_password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="new-password">New Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="new-password" name="new_password" class="text-field" placeholder="New Password">
                                <p id="password-new_password"></p>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="confirm-password">Confirm Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="confirm-password" name="confirm_password" class="text-field" placeholder="Confirm Password">
                                <p id="password-confirm_password"></p>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Password /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection
