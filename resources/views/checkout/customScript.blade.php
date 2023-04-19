@section('bottom-script')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        /* getting a stripe key from a environment */
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const modifyingDefaultStripeStyles={
            base: {
                '::placeholder': {
                    'opacity': '1',
                    'fontSize':'14px',
                    'color': '#d9d9d9',
                },
                'color': '#9e9e9e'
            }
        };
        /* creating a stripe element using stripe js */
        const elements = stripe.elements();
        const cardNumber = elements.create('cardNumber',{style: modifyingDefaultStripeStyles});
        cardNumber.mount('#card-number');
        const cardExpiry = elements.create('cardExpiry',{style: modifyingDefaultStripeStyles});
        cardExpiry.mount('#card-expiry');
        const cardCvv = elements.create('cardCvc',{style: modifyingDefaultStripeStyles});
        cardCvv.mount('#card-cvc');
        const cardHolderName = document.getElementById('name_on_card');
        const purchaseButton = document.getElementById('card-button');
        /* getting a user secrect id by from a stripe */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let getSetupIntent=()=>{
            return new Promise((done, fail) => {
                $.ajax({
                    url: "{{route('getSetUpIntentValue')}}",
                    type: 'POST',
                    success: function (data) {
                        done(data.intent_id)
                    },
                    error: function (error) {
                        fail(error.msg)
                    },
                });
            });
        }
        /* Stripe payment process */
        purchaseButton.addEventListener('click', async (e) => {
            $('.ngg-loader').show();
            getSetupIntent().then((intentId) => {
                let clientSecretID = intentId;
                stripe.confirmCardSetup(
                    clientSecretID, {
                        payment_method: {
                            card: cardNumber,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                ).then(function (response) {
                    $('.ngg-loader').hide();
                    if(response.error){
                        $('#ngg-credit-card-errors').text(response.error.message)
                    }
                    else{
                        $('#ngg-credit-card-errors').empty();
                        $('.payment-method').val(response.setupIntent.payment_method);
                        $("#ngg-payment").submit();
                    }
                });
            }).catch((errorMsg) => {
                $('.nggInfoMsg').html(errorMsg);
                $('#ngg_info_alert').modal('show');
                $('.ngg-loader').hide();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#ngg-payment").validate({
                rules: {
                    shippingAddress1: {required: true},
                    shippingAddress2: {required: true},
                    shippingCity: {required: true},
                    shippingState: {required: true},
                    shippingZipcode: {required: true},
                    shippingCountry: {required: true},
                    name_on_card: {required: true},
                },
                messages: {
                    shippingAddress1: "Address1 field is required.",
                    shippingAddress2: "Address2 field is required.",
                    shippingCity: "City field is required.",
                    shippingState: "State field is required.",
                    shippingZipcode: "Zipcode field is required.",
                    shippingCountry: "Country field is required.",
                    name_on_card: "Card holder name is required.",
                },
                submitHandler: function(form) {
                    $('.ngg-loader').show();
                    form.submit();
                }
            });
        });
    </script>
@endsection
