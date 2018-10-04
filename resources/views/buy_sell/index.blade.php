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
    .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
    }
    .card-product .img-wrap img {
        max-height: 100%;
        max-width: 100%;
        object-fit: cover;
    }
    .card-product .info-wrap {
        overflow: hidden;
        padding: 15px;
        border-top: 1px solid #eee;
    }
    .card-product .bottom-wrap {
        padding: 15px;
        border-top: 1px solid #eee;
    }

    .label-rating { margin-right:10px;
        color: #333;
        display: inline-block;
        vertical-align: middle;
    }

    .card-product .price-old {
        color: #999;
    }
</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <h1 class="text-center">Our Commodity</h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                @foreach($categories as $key => $category)
                <div class="col-md-3">
                    <figure class="card card-product">
                        <div class="img-wrap">
                            <img src="{{ asset('resources/assets/upload/category/'.$category->image) }}" class="img-responsive" style="width: 100%;height: 200px;">
                        </div>
                        <figcaption class="info-wrap">
                                <h4 class="title text-center">{{ $category->category }}</h4>

                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="{!! route('buy_sell_view', ['id' => $category->id]) !!}" class="btn btn-sm btn-primary btn-block">View Product</a> 
                        </div> <!-- bottom-wrap.// -->
                    </figure>
                </div> <!-- col // -->
                @endforeach
            </div>
        </div> <!-- row.// -->
    </div>
</section>
@endsection