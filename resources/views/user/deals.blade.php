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

                @php
                    $user = DB::table('user_roles')->where('user_id', Auth::user()->id)->first();
                    $role_id = $user->role_id;
                @endphp

                @if($role_id == 5)
                    <h2 class="section-heading text-center">My Sell</h2><hr>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Terminal</th>
                                <th scope="col">Location</th>
                                <th scope="col">Buyer</th>
                                <th scope="col">Commodity</th>
                                <th scope="col">Quantity (Qtl.)</th>
                                <th scope="col">Quality Categgory</th>
                                <th scope="col">Price (Rs/Qtl.)</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sells as $key => $sell)
                                    <tr>
                                        <td>{{ $sell->name }}</td>
                                        <td>{{ $sell->location }}</td>
                                        <td>{{ $sell->fname }}</td>
                                        <td>{{ $sell->category }}</td>
                                        <td>{{ $sell->quantity }}</td>
                                        <td>{{ $sell->quality_category }}</td>
                                        <td>{{ $sell->price }}</td>
                                        <td>{{ $sell->created_at }}</td>
                                        @if($sell->status == 2)
                                            <td><strong class="red">Pending With Admin</strong></td>
                                        @elseif($sell->status == 3)
                                            <td><strong style="color:green;">Success</strong></td>
                                        @endif
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>

                @elseif($role_id == 6)
                    <h2 class="section-heading text-center">My Purchase</h2><hr>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Terminal</th>
                                <th scope="col">Location</th>
                                <th scope="col">Commodity</th>
                                <th scope="col">Quantity (Qtl.)</th>
                                <th scope="col">Quality Categgory</th>
                                <th scope="col">Price (Rs/Qtl.)</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buys as $key => $buy)
                                @if($buy->status == 2)
                                    <tr>
                                        <td>{{ $buy->name }}</td>
                                        <td>{{ $buy->location }}</td>
                                        <td>{{ $buy->category }}</td>
                                        <td>{{ $buy->quantity }}</td>
                                        <td>{{ $buy->quality_category }}</td>
                                        <td>{{ $buy->price }}</td>
                                        <td>{{ $buy->created_at }}</td>
                                        <td><b class="red">Pending With Admin</b></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection