@extends('layouts.app')
@section('content')
<div class="container ngg-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>{{ __('My-Orders') }}</h2></div>
                <div class="card-body">
                    <table class="table table-bordered ngg-order-list table-striped" id="ngg-orderList">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Product Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($orders))
                                @foreach($orders as $ordersKey=>$ordersinfo)
                                    <tr>
                                        <td>{{ $ordersKey+1 }}</td>
                                        <td>{{ $ordersinfo->order_number }}</td>
                                        <td>{{ $ordersinfo->product->name }}</td>
                                        <td>{{ '$'.$ordersinfo->price }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-script')
<script type="text/javascript">
    $(document).ready(function(){
        /* Pagination for my-order list table */
        if($('#ngg-orderList').length>0){
            $('#ngg-orderList').DataTable({
                searching: false,
                "iDisplayLength": 10,
                "bLengthChange" : false,
                "bInfo":false,
                pagingType: 'full_numbers',
            });
        }
    });
</script>
@endsection
