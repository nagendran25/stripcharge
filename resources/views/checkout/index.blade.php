@extends('layouts.app')
@section('content')
<div class="container ngg_container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>{{ __('Checkout') }}<h2></div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger ngg-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="col-md-12 ngg-checkout-wrapper">
                        @include('checkout.order_detail')
                        <div class="row">
                            <div class="col-md-12">
                                <form id="ngg-payment" method="POST" action="{{ route('paymentProcess') }}" class="ngg-order-form card-form mt-3 mb-3">
                                    @csrf
                                    @include('checkout.order_shipping')
                                    @include('checkout.order_payment')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('default.info-modal')
@include('default.loader')
@endsection
@include('checkout.customScript')
