@extends('layouts.public_app')

@section('content')
<style>
    .py-4{
        padding-top: 0rem!important;
    }
    .masthead{
        height: 20vh!important;
        min-height: 140px!important;
    }
</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <h2 class="section-heading text-center">Buy /Sell</h2>
                
                <hr>

                <h4 class="section-heading text-center">Sell Products</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Warehouse</th>
                            <th scope="col">Commodity</th>
                            <th scope="col">Quantity (Bags)</th>
                            <th scope="col">Price (Rs/Bag)</th>
                            <th scope="col">Date</th>
                            <th scope="col">Bid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sells as $key => $sell)
                            <tr>
                                <td>{{ $sell->name }}</td>
                                <td>{{ $sell->category }}</td>
                                <td>{{ $sell->quantity }}</td>                                 
                                <td>{{ $sell->price }}</td>
                                <td>{{ $sell->created_at }}</td>
                                <td>
                                    @if($sell->status == 2)
                                        
                                        <a href="javascript:;" class="btn btn-info">Deal Done</a>

                                    @else
                                        <a href="{{ route('bidding', ['deal_id' => $sell->id]) }}" class="btn btn-info">Bid</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="clearfix">&nbsp;</div>
                <div class="clearfix">&nbsp;</div>

                <h4 class="section-heading text-center">Buy Products</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Warehouse</th>
                            <th scope="col">Commodity</th>
                            <th scope="col">Quantity (Bags)</th>
                            <th scope="col">Price (Rs/Bag)</th>
                            <th scope="col">Date</th>
                            <th scope="col">Bid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buys as $key => $buy)
                            <tr>
                                <td>{{ $buy->name }}</td>
                                <td>{{ $buy->category }}</td>
                                <td>{{ $buy->quantity }}</td>
                                <td>{{ $buy->price }}</td>
                                <td>{{ $buy->created_at }}</td>
                                <td>
                                    @if($buy->status == 2)
                                        
                                        <a href="javascript:;" class="btn btn-info">Deal Done</a>

                                    @else
                                        <a href="{{ route('bidding', ['deal_id' => $buy->id]) }}" class="btn btn-info">Bid</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <hr>
            </div>

        </div>
    </div>
</section>

@endsection