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
            @if(session('status'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        <div class="row">

            <div class="col-lg-12 text-center">

                <h2 class="section-heading">Inventory</h2>
                <hr>
            </div>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Commodity</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Price</th>
                      <th scope="col">Create Date</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $key => $inventory)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $inventory->cat_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td id="price_{{ $inventory->id }}" val="{{ $inventory->price }}"><i class="fa fa-inr"></i> {{ $inventory->price }}</td>
                        <td>{{ $inventory->created_at }}</td>
                        <td>
                            <a href="#{{ $inventory->id }}" id="{{ $inventory->id }}" class="btn btn-info btn-sm price" title="Edit Price">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection