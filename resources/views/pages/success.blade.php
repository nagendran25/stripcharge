@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="text-center">
                        <h2>{{ __('Thankyou you for purchasing') }}</h2>
                        <img src="{{ asset('images/payment-success.jpeg') }}" alt="payment-success"/>
                        <h5>{{ Session::get('success') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
