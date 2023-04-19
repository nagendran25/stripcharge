<h3>Delivery address</h3>
<div class="row ngg_delivery_addess_sec">
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingAddress1">Address 1<span class="ngg-req">*</span></label>
            <input id="shippingAddress1" class="form-control" name="shippingAddress1" type="text" value="{{ old('shippingAddress1') }}" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingAddress2">Address 2<span class="ngg-req">*</span></label>
            <input id="shippingAddress2" class="form-control" name="shippingAddress2" type="text" value="{{ old('shippingAddress2') }}" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingCity">City<span class="ngg-req">*</span></label>
            <input id="shippingCity" class="form-control" name="shippingCity" type="text" value="{{ old('shippingCity') }}" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingState">State<span class="ngg-req">*</span></label>
            <input id="shippingState" class="form-control" name="shippingState" type="text" value="{{ old('shippingState') }}" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingZipcode">Zipcode<span class="ngg-req">*</span></label>
            <input id="shippingZipcode" class="form-control" name="shippingZipcode" type="number" value="{{ old('shippingZipcode') }}" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="shippingCountry">Country<span class="ngg-req">*</span></label>
            <select class="form-control" id="shippingCountry" name="shippingCountry">
                <option value="US">United States</option>
            </select>
        </div>
    </div>
</div>
