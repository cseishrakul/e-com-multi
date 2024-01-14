@if (count($deliveryAddresses) > 0)
    <h4 class="section-h4">Delivery Addresses</h4>
    @foreach ($deliveryAddresses as $address)
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex">
                    <div class="control-group">
                        <input type="radio" name="address_id" id="address{{ $address['id'] }}"
                            value="{{ $address['id'] }}">
                    </div>
                    &nbsp;&nbsp;
                    <div class="mb-3">
                        <label for="control-label">{{ $address['name'] }}, {{ $address['address'] }},
                            {{ $address['city'] }},
                            {{ $address['state'] }},{{ $address['country'] }},{{ $address['mobile'] }} </label>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="d-flex">
                    <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="editAddress mr-1"
                    style="">Edit</a>
                <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="removeAddress"
                    style="">Remove</a>
                </div>
            </div>
        </div>
    @endforeach
@endif
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
        <input type="hidden" name="delivery_id">
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">Name
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_name" name="delivery_name" class="text-field">
                <p id="delivery-delivery_name"></p>
            </div>
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">Address
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_address" name="delivery_address" class="text-field">
                <p id="delivery-delivery_address"></p>
            </div>
        </div>
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">City
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_city" name="delivery_city" class="text-field">
                <p id="delivery-delivery_city"></p>
            </div>
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">State
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_state" name="delivery_state" class="text-field">
                <p id="delivery-delivery_state"></p>
            </div>
        </div>
        <div class="u-s-m-b-30">
            <label for="country">Country
                <span class="astk">*</span>
            </label>
            <select name="delivery_country" id="delivery_country" class="text-field">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == Auth::user()->country) selected @endif>
                        {{ $country['country_name'] }} </option>
                @endforeach
            </select>
            <p id="delivery-delivery_country"></p>
        </div>
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">Pincode
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_pincode" name="delivery_pincode" class="text-field">
                <p id="delivery-delivery_pincode"></p>
            </div>
            <div class="group-1 u-s-p-r-16">
                <label for="first-name-extra">Mobile
                    <span class="astk">*</span>
                </label>
                <input type="text" id="delivery_mobile" name="delivery_mobile" class="text-field">
                <p id="delivery-delivery_mobile"></p>
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
