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
                <h3 class="text-center" style="color: #00ccff;">“An exclusive portal for farmers / village level collectors
where they can avail Warehousing , Commodity Finance and
Market linkage all three facilities at one place”</h3> 
                <p>Farmers don’t have access to warehousing facilities and
                commodity finance since warehouses are situated at far off
                locations. They sell their commodity immediately post harvest at
                lower price and don’t get the benefit of price appreciation.</p>
                <p>We identify closed factories, Old sheds and abandoned buildings
NEAR production area and convert them into agriculture
warehouses where the farmers can keep the Agri commodity and
avail commodity loan by pledging the stock. When prices of agri
produce are better then they can sell the stock to millers on the
apnagodam portal on “ As is Where is basis”.</p>
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
<!--                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Moisture Meter</h4>
                            </div>
                        </a>
                    </div>  -->                   
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
                            <i class="fa fa-compass" aria-hidden="true"></i>
                            <br>
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Online Kanta Parchi</h4>
                            </div>
                        </a>
                    </div>                    
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 apna">
                        <a href="">
                            <i class="fa fa-home" aria-hidden="true"></i>
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
