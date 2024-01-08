@if (count($deliveryAddresses) > 0)
    <h4 class="section-h4">Delivery Addresses</h4>
    @foreach ($deliveryAddresses as $address)
        <div class="d-flex">
            <div class="control-group">
                <input type="radio" name="address_id" id="address{{ $address['id'] }}" value="{{ $address['id'] }}">
            </div>
            &nbsp;&nbsp;
            <div class="mb-3">
                <label for="control-label">{{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }},
                    <!--{{ $address['state'] }}, -->{{ $address['country'] }},{{ $address['mobile'] }} </label>
            </div>
            <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="editAddress mx-5" style="">Edit</a>
        </div>
    @endforeach
    <h4 class="section-h4 deliveryText">Add New Delivery Address</h4>
    <div class="u-s-m-b-24">
        <input type="checkbox" class="check-box" id="ship-to-different-address" data-toggle="collapse"
            data-target="#showdifferent">
        <label class="label-text newAddress" for="ship-to-different-address">Ship to a different
            address?</label>
    </div>
    <div class="collapse" id="showdifferent">
        <!-- Form-Fields -->
        <form id="addressAddEditForm" action="javascript:;" method="POST">
            @csrf
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">Name
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_name" name="delivery_name" class="text-field">
                </div>
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">Address
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_address" name="delivery_address" class="text-field">
                </div>
            </div>
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">City
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_city" name="delivery_city" class="text-field">
                </div>
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">State
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_state" name="delivery_state" class="text-field">
                </div>
            </div>
            <div class="u-s-m-b-30">
                <label for="country">Country
                    <span class="astk">*</span>
                </label>
                <select name="delivery_country" id="delivery_country" class="text-field">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country['country_name'] }}"
                            @if ($country['country_name'] == Auth::user()->country) selected @endif>
                            {{ $country['country_name'] }} </option>
                    @endforeach
                </select>
                <p id="account-country"></p>
            </div>
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">Pincode
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_pincode" name="delivery_pincode" class="text-field">
                </div>
                <div class="group-1 u-s-p-r-16">
                    <label for="first-name-extra">Mobile
                        <span class="astk">*</span>
                    </label>
                    <input type="text" id="delivery_mobile" name="delivery_mobile" class="text-field">
                </div>
            </div>
            <div class="order-table" style="border:none;">
                <button type="submit" class="button button-outline-secondary">Add / Edit Address</button>
            </div>
        </form>
        <!-- Form-Fields /- -->
    </div>
    <div>
        <label for="order-notes">Order Notes</label>
        <textarea class="text-area" id="order-notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
    </div>
@else
    <h4 class="section-h4">Add New Delivery Address</h4>
    <!-- Form-Fields -->
    <div class="group-inline u-s-m-b-13">
        <div class="group-1 u-s-p-r-16">
            <label for="first-name">First Name
                <span class="astk">*</span>
            </label>
            <input type="text" id="first-name" class="text-field">
        </div>
        <div class="group-2">
            <label for="last-name">Last Name
                <span class="astk">*</span>
            </label>
            <input type="text" id="last-name" class="text-field">
        </div>
    </div>
    <div class="u-s-m-b-13">
        <label for="select-country">Country
            <span class="astk">*</span>
        </label>
        <div class="select-box-wrapper">
            <select class="select-box" id="select-country">
                <option selected="selected" value="">Choose your country...</option>
                <option value="">United Kingdom (UK)</option>
                <option value="">United States (US)</option>
                <option value="">United Arab Emirates (UAE)</option>
            </select>
        </div>
    </div>
    <div class="street-address u-s-m-b-13">
        <label for="req-st-address">Street Address
            <span class="astk">*</span>
        </label>
        <input type="text" id="req-st-address" class="text-field" placeholder="House name and street name">
        <label class="sr-only" for="opt-st-address"></label>
        <input type="text" id="opt-st-address" class="text-field"
            placeholder="Apartment, suite unit etc. (optional)">
    </div>
    <div class="u-s-m-b-13">
        <label for="town-city">Town / City
            <span class="astk">*</span>
        </label>
        <input type="text" id="town-city" class="text-field">
    </div>
    <div class="u-s-m-b-13">
        <label for="select-state">State / Country
            <span class="astk"> *</span>
        </label>
        <div class="select-box-wrapper">
            <select class="select-box" id="select-state">
                <option selected="selected" value="">Choose your state...</option>
                <option value="">Alabama</option>
                <option value="">Alaska</option>
                <option value="">Arizona</option>
            </select>
        </div>
    </div>
    <div class="u-s-m-b-13">
        <label for="postcode">Postcode / Zip
            <span class="astk">*</span>
        </label>
        <input type="text" id="postcode" class="text-field">
    </div>
    <div class="group-inline u-s-m-b-13">
        <div class="group-1 u-s-p-r-16">
            <label for="email">Email address
                <span class="astk">*</span>
            </label>
            <input type="text" id="email" class="text-field">
        </div>
        <div class="group-2">
            <label for="phone">Phone
                <span class="astk">*</span>
            </label>
            <input type="text" id="phone" class="text-field">
        </div>
    </div>
    <div class="u-s-m-b-30">
        <input type="checkbox" class="check-box" id="create-account">
        <label class="label-text" for="create-account">Create Account</label>
    </div>
    <!-- Form-Fields /- -->
@endif
