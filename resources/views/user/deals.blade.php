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
                                <th scope="col">Commodity</th>
                                <th scope="col">Quantity (Qtl.)</th>
                                <th scope="col">Quality Categgory</th>
                                <th scope="col">Price (Rs/Qtl.)</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sells as $key => $sell)
                                <tr>
                                    <td>{{ $sell->name }}</td>
                                    <td>{{ $sell->village }}</td>
                                    <td>{{ $sell->category }}</td>
                                    <td>{{ $sell->quantity }}</td>
                                    <td>{{ $sell->quality_category }}</td>
                                    <td>{{ $sell->price }}</td>
                                    <td>{{ $sell->created_at }}</td>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buys as $key => $buy)
                                <tr>
                                    <td>{{ $buy->name }}</td>
                                    <td>{{ $buy->village }}</td>
                                    <td>{{ $buy->category }}</td>
                                    <td>{{ $buy->quantity }}</td>
                                    <td>{{ $buy->quality_category }}</td>
                                    <td>{{ $buy->price }}</td>
                                    <td>{{ $buy->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection