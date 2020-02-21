@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Terminals') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Terminals</a>
        </div>
    </div>
</section>

<section class="service_area">
    <div class="container">
        <div class="row service_list_inner">
            <div class="col-md-12">
                <div class="row service_list_item_inner">
                    @foreach($warehouses as $key => $warehouse)
                        <div class="col-md-4 col-xs-6 m-h-410">
                            <a href="{!! route('terminal_view', ['id' => $warehouse->id]) !!}">
                                <div class="image_s_list m-h-410">
                                    <img src="<?= ($warehouse->image)?asset('resources/assets/upload/warehouses/'.$warehouse->image):asset('resources/assets/upload/warehouses/terminal.jpg');?>">
                                    <h3 class="single_title">{!! $warehouse->name !!}</h3>
                                    <p>{!! ucfirst($warehouse->location) !!}</p>
                                    <a class="more_btn" href="service-detail2.html"> Book Now<i class="fa fa-angle-right"></i></a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-t-10">
                <h3 class="p-t-10 text-center">Features in all our Terminals</h3><hr/>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-credit-card" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>Finance</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-camera" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>CCTV</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-shopping-cart" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>Loading Machine</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-rss" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>Internet</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-fire" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>Fire Safety</h4>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-center">
                    <i class="fa-4x fa fa-compass" aria-hidden="true"></i>
                    <br>
                    <div class="s-content">
                        <h4>Online Kanta Parchi</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
