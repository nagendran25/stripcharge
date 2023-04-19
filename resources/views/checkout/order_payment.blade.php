<h3>Credit Card Payment</h3>
<div class="row ngg_credit_card_details">
    <div class="col-md-6">
        <div class="form-group cardHName">
            <label for="name_on_card" class="ngg_cardHolderName">Card Holder Name<span class="ngg-req">*</span></label>
            <input id="name_on_card" class="form-control" name="name_on_card" type="text" value="{{ old('name_on_card') }}" autocomplete="name_on_card" autofocus />
        </div>
        </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="ngg_cardNumber">Card Number<span class="ngg-req">*</span></label>
            <div id="card-number"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="ngg_card_expiry_date">Expiration Date(MM/YY)<span class="ngg-req">*</span></label>
            <div id="card-expiry"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="ngg_card_cvv_number">CVV Number<span class="ngg-req">*</span></label>
            <div id="card-cvc"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div id="ngg-credit-card-errors" role="alert"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
    <div class="form-group mt-3">
        <input type="hidden" name="productInfo" value="{{ Crypt::encryptString($productInfo->id) }}" />
        <input type="hidden" name="payment_method" class="payment-method">
        <a id="card-button" class="btn btn-bg btn-success pay">Submit</a>
    </div>
</div>
