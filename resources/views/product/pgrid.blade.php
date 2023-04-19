@extends('layouts.app')
@section('content')
<div class="container ngg_pgrid_container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>{{ __('Products') }}</h2></div>
                <div class="card-body">
                    @include('default.flash-message')
                    @if(!$products->isEmpty())
                        <div class="row">
                            @foreach($products as $nggProdinfo)
                                <div class="col-12 col-md-6 col-lg-4 mb-2 ngg_product_list">
                                    <div class="card">
                                        <div class="card-body">
                                        <h4 class="card-title"><b>{{ $nggProdinfo->name }}</b></h4>
                                        <p class="card-text ngg_desc">{{ $nggProdinfo->DescriptionExcerpt }}</p>
                                        <div class="row pt-5">
                                            <div class="col-md-6 sp-col-md-6 col-xs-12">
                                            <a class="btn btn-success btn-bg buy-now-btn" href="{{ route('productCheckout',['id'=>Crypt::encryptString($nggProdinfo->id)]) }}">Buy Now</a>
                                            </div>
                                            <div class="col-md-6 sp-col-md-6 col-xs-12">
                                                <p class="card-text text-right"><b>{{ '$'.$nggProdinfo->price }}</b></p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $products->links() }}
                    @else
                        <p class="text-center ngg_perror"><b>Product is not found.</b></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
