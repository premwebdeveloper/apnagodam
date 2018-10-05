@extends('layouts.public_app')

@section('content')
<style type="text/css">
    .apna .fa{
        font-size: 50px;
        margin-bottom: 20px;
    }
</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="section-heading text-center">{{ __('About Us') }}</h2>
                <hr>
                <h3 class="text-center" style="color: #00ccff;">“An exclusive portal in Agri Warehousing which connects farmers / traders with the godown owners “</h3> 
                <p>There are old sheds / buildings and storage areas which are lying idle / vacant and at the same time the farmers / traders in that area are sending their Agri produce for storage at distant area after incurring huge cost on transportation.</p>
                <p><strong style="font-size:20px">Apna Godam</strong>  is a platform to connect both and hence the idle assets are put to use and the Agri produce is preserved as well.</p>
                <br>
                <h4 class="text-center">Features in all our Warehouses</h4>
                <br>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Finance</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">CCTV</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">loading Machine</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-rss" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Internet</h4>
                            </div>
                        </a>
                    </div>
                </div>                
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Moisture Meter</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-fire" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Fire Safety</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Online Kanta Parchi</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-rss" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Storage</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
