@extends('layouts.public_app')

@section('content')

<style type="text/css">
    .amit{
        display: inline-flex;
        list-style-type: none;
        margin-bottom: 0;
    }
    .amit li{
        margin-left: 20px;
    }
</style>

<main id="main"> <!-- main body conatiner starts-->
    <header class="">
         <link href="{{ asset('resources/frontend_assets/css/responsive-slider.css') }}" rel="stylesheet">
        <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
            <div class="slides apna_godam1" data-group="slides">
                <ul>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner1.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner2.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner3.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner4.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner5.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner6.jpg') }}">
                        </div>
                    </li>

                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner7.jpg') }}">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <script src="{{ asset('resources/frontend_assets/js/jquery.event.move.js') }}"></script>
        <script src="{{ asset('resources/frontend_assets/js/responsive-slider.js') }}"></script>
    </header>
        <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading">Services We Provide</h2>
                    <hr class="my-4">
                    <p>Through our experienced operations team we can handle various kind of supply chain operations and services</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <a href="{{ route('inventories') }}">
                            <i class="fa fa-warehouse"></i>
                            <h4 class="mb-2">Warehousing Services</h4><br />
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box mt-5 mx-auto" style="background: #012b72;">
                        <i class="fa fa-rupee-sign" style="color:#fff"></i>
                        <h4 class="mb-2" style="color:#fff">Financing</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fab fa-buysellads"></i>
                        <h4 class="mb-2">Buy and Sell</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="featured">
        <h2 class="section-heading text-center">Today's Price (Per Qtl)</h2>
        <h6 class="section-heading text-center">Last Update Date : <?= date('d-m-Y'); ?></h6>
        <div class="container-fluid">
            <div class="row pt-4">
                <div class="col-md-12">

                    <script type="text/javascript">
                        $(document).ready(function(){

                            $(document).on('change', '#mandi', function(){

                                var mandi = $(this).val();

                                // If there is any mandi selected
                                if(mandi != ''){

                                    $.ajax({
                                        method : 'POST',
                                        url : '{{ url("get_todays_price") }}',
                                        async : true,
                                        data : { '_token' : '{{ csrf_token() }}', 'mandi' : mandi},
                                        success : function(response){
                                            console.log(response);

                                            $('#featured-caro').html(response);
                                        },
                                        error: function(data) { // What to do if we fail
                                            console.log(data);
                                        }
                                    });
                                }
                            });
                        });
                    </script>

                    <div class="col-md-12">
                        <form>
                            <span style="font-weight: bold;background-color: grey;padding: 2px 10px;">
                                <a href="">Commodity Wise</a>
                            </span>
                            
                        </form>
                    </div>

                    <div id="featured-caro" class="owl-carousel">
                        @foreach($today_prices as $key => $today_price)
                        <div class="item">
                            <img class="iblock bline" style="height: 220px;" src="{{ asset('resources/assets/upload/category/'.$today_price->image) }}"> <br>
                            <span class="iblock bline">&nbsp; {!! $today_price->commodity !!}</span>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td width="15">
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </td>
                                        <td>
                                            <span id="ContentPlaceHolder1_rptScroller1_lblModal_39">Modal</span>
                                        </td>
                                        <td width="10">
                                            :
                                        </td>
                                        <td>
                                            {!! $today_price->modal !!}&nbsp;₹
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15">
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </td>
                                        <td>
                                            <span id="ContentPlaceHolder1_rptScroller1_lblMax_39">Max</span>
                                        </td>
                                        <td width="10">
                                            :
                                        </td>
                                        <td>
                                            {!! $today_price->max !!}&nbsp;₹

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15">
                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                        </td>
                                        <td>
                                            <span id="ContentPlaceHolder1_rptScroller1_lblMin_39">Min</span>
                                        </td>
                                        <td width="10">
                                            :
                                        </td>
                                        <td>
                                            {!! $today_price->min !!}&nbsp;₹
                                        </td>
                                    </tr>
                                    <tr><td colspan="4" class="text-center" style="font-weight: 700;background-color: gray;color:#fff;padding: 2px 0px;font-size: 18px;">{{ $today_price->terminal_name }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                    <div class="customNavigation">
                        <a class="btn prev"><i class="fa fa-chevron-left"></i></a>
                        <a class="btn next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Bid Time</h3>
                </div>
                <div class="col-md-4 text-right">
                    <h4><b>Bid Time : </b><b class="red"> 08:00AM - 03:00PM</b></h4>
                </div>
                <div class="col-md-4 text-center">
                    <h4><b>Bid Close Time : </b><b class="red"> 03:00PM - 03:30PM</b></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Deal Close Time : </b><b class="red"> 03:30PM - 04:30PM</b></h4>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h2 class="section-heading">Welcome to Apna Godam</h2>

                <hr class="margin-unset">
                <div class="text-justify">
                    <p class="mb-4"><b>“An exclusive portal for Sellers / village level collectors
    where they can avail Warehousing , Commodity Finance and
    Market linkage all three facilities at one place”</b></p>
                    <p class="mb-4">
                    Sellers don’t have access to warehousing facilities and
                    commodity finance since Terminals are situated at far off
                    locations. They sell their commodity immediately post harvest at
                    lower price and don’t get the benefit of price appreciation.</p>
                    <p class="mb-4">
                    We identify closed factories, Old sheds and abandoned buildings
    NEAR production area and convert them into agriculture
    Terminals where the Sellers can keep the Agri commodity and
    avail commodity loan by pledging the stock. When prices of agri
    produce are better then they can sell the stock to millers on the
    apnagodam portal on “ As is Where is basis”.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img class="max-100" src="{{ asset('resources/frontend_assets/img/farmer.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <section id="why-us">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-lg-auto text-lg-center">
                    <h2 class="section-heading">Why Apna Godam</h2>
                    <hr class="my-4 mob-left">
                    <p>We remove inefficiency in the entire supply chain and save cost to the Sellers</p>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light mt-4">
        <div class="row pb-2">
            <div class="col-lg-6l px-0">
                <img class="full-100 p-4 p-lg-0" src="{{ asset('resources/frontend_assets/img/strenght.png') }}" style="width: 91%;height: 500px;">
            </div>

            <div class="col-lg-6s my-auto text-lg-center px-0">
                <div class="iblock px-5">
                    <h2 class="text-left section-heading">Our Strength</h2>

                    <ul class="text-left">
                        <li>Terminals NEAR FARM</li>
                        <li>Affordable storage solution</li>
                        <li>Paper less loan process in just 10 minutes</li>
                        <li>Online CCTV access to customers</li>
                        <li>Online sale of agri commodity on “ As is where is basis”.</li>
                        <li>System and process driven organization.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-lg-6l col-lg-push-6l px-0">
                <img class="full-100 p-4 p-lg-0" src="{{ asset('resources/frontend_assets/img/benifits.png') }}">
            </div>
            <div class="col-lg-6s col-lg-pull-6s my-auto text-lg-center px-0">
                <div class="iblock px-5">
                <h2 class="text-left section-heading">Benefits to Sellers</h2>

                <ul class="text-left">
                    <li>Low transportation cost as the warehouse is nearby</li>
                    <li>Just send the commodity in warehouse and relax , everything is online</li>
                    <li>Proper Fumigations and spray to keep the commodity safe</li>
                    <li>Millers on board to purchase the commodity from Terminals</li>
                    <li>Grading / sorting facility in some Terminals</li>
                </ul>
                </div>
            </div>
        </div>
    </div>

    </section>

    <section id="featured">
      <div class="container-fluid">
        <div class="row pt-4">
            <div class="col-md-3 text-center my-auto">
                <div class="iblock text-left quoted">
                    <h2 class="section-heading text-center text-md-left">Testimonials</h2>
                    <hr class="mx-lg-0 mx-auto">
                </div>
            </div>
            <div class="col-md-9">

                <div id="featured-caro" class="owl-carousel">
                    <div class="item">
                        <p class="pb-2">We are getting better realization of produce by using Agri warehousing facility which is provided at nominal cost and near to us. We get sms on our mobile phone for every transaction.</p>
                        <img class="iblock bline" src="{{ asset('resources/frontend_assets/img/q1.png') }}"> <span class="iblock bline">&nbsp; Baldev Chaudhary (Seller)</span>
                    </div>
                    <div class="item">
                        <p class="pb-2">This is the first time we used Agri Godam of this company and the experience was wonderful. Specially online CCTV footage access and real time kanta parchi is unique feature of this warehouse.</p>
                        <img class="iblock bline" src="{{ asset('resources/frontend_assets/img/qwe.png') }}"> <span class="iblock bline">&nbsp; Lokesh Agarwal ( Trader)</span>
                    </div>
                    <div class="item">
                        <p class="pb-2">Our Shed was lying unused since last 15 years. I am grateful to Apna Godam Team for making best use of it. We are not earning only money but the idle resource of the country has been put to use.</p>
                        <img class="iblock bline" src="{{ asset('resources/frontend_assets/img/gzz.png') }}"> <span class="iblock bline">&nbsp; Karun Modi  ( Godam owner)</span>

                    </div>
                </div>
                <div class="customNavigation">
                    <a class="btn prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="btn next"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<!-- Page Content Ends -->

@endsection
