@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('About Us') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">About Us</a>
        </div>
    </div>
</section>

<section class="our_about_area p-50">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="our_about_image">
                    <img src="{{ asset('resources/frontend_assets/theme/img/farmer.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <div class="our_about_left_content">
                    <h3 class="single_title p-b-10">Welcome to Apna Godam</h3>
                    <b>“An exclusive portal for Sellers / village level collectors where they can avail Warehousing , Commodity Finance and Market linkage all three facilities at one place”</b>
                    <p>ApnaGodam is a Jaipur based Agritech Startup providing warehousing facilities and online commodity financing to farmers all across India. In addition to ths, ApnaGodam facilitates an online platform that facilitate farmers, traders and buyers with online trading in commodities.Thus helping in better price discovery and provide facilities for smooth marketing of their produce.</p>
                    <p>Sellers don’t have access to warehousing facilities and commodity finance since Terminals are situated at far off locations. They sell their commodity immediately post harvest at lower price and don’t get the benefit of price appreciation.</p>
                    <p>We identify closed factories, Old sheds and abandoned buildings NEAR production area and convert them into agriculture Terminals where the Sellers can keep the Agri commodity and avail commodity loan by pledging the stock. When prices of agri produce are better then they can sell the stock to millers on the apnagodam portal on “ As is Where is basis”.

                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="global_text_area p-40">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="global_text_item">
                    <h3 class="single_title">Benefits to Sellers</h3>
                    <ul class="s_list">
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Low transportation cost as the warehouse is nearby</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Just send the commodity in warehouse and relax , everything is online</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Proper Fumigations and spray to keep the commodity safe </a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Millers on board to purchase the commodity from Terminals</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Grading / sorting facility in some Terminals</a></li>            
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="global_text_item">
                    <h3 class="single_title">Our Strength</h3>
                    <ul class="s_list">
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Terminals NEAR FARM</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Affordable storage solution</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Paper less loan process in just 10 minutes</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Online CCTV access to customers</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>Online sale of agri commodity on “ As is where is basis”.</a></li>
                        <li><a><i class="fa fa-check" aria-hidden="true"></i>System and process driven organization.</a></li>            
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why_choose_area p-t-40 p-b-40">
    <div class="container">
        <div class="row">
            <div class="col-md-5 text-center">
                <img class="w-100" src="{{ asset('resources/frontend_assets/theme/img/why-us-img.png') }}" alt="">
            </div>
            <div class="col-md-7">
                <br>
                <h3 class="single_title p-b-10">Apnagodam - PHYGITAL WAREHOUSING</h3>
                <hr class="m-t-0">
                <p><b>The emergence of phygital experiences demands increasingly more connectivity between products (and services) and the customers (and clients) who use them.</b></p><br>
                <p>Apnagodam introduces Phygital Warehousing System  thus blending digital experiences with physical ones. As the channels of customer interaction and communication proliferate, we aim to make  these channels frictionless and seamless, enabling a Seller/Buyer to make a phone call, and conduct their online trade via our IVR system .</p>
            </div>
        </div>
    </div>
</section>

<section class="our_team_area p-40">
    <div class="container">
        <h3 class="single_title p-10">Our Team</h3>
        <div class="our_team_slider owl-carousel">
            <div class="item">
                <div class="team">
                    <div class="team_img">
                        <div class="img">
                            <img src="{{ asset('resources/frontend_assets/theme/img/team/team1.jpg') }}" alt="">
                        </div>
                    </div>
                    <a href="#">
                        <h2>Mr. Sitaram Agarwal</h2>
                    </a>
                    <p>63 years old is the promoter of the Company. He has been in the Agriculture trade since last 40 Years. The objective behind this venture is to increase the holding capacity of the Seller by providing Agri warehouses near to Sellers at affordable price so that he can realize better value for his Agri produce.</p>
                </div>
            </div>
            <div class="item">
                <div class="team">
                    <div class="team_img">
                        <div class="img">
                            <img src="{{ asset('resources/frontend_assets/theme/img/team/team2.jpg') }}" alt="">
                        </div>
                    </div>
                    <a href="#">
                        <h2>Sanjay Agarwal</h2>
                    </a>
                    <p>Sanjay Agarwal is a chartered accountant and a company secretary by qualification and brings with him 11 years of experience in finance in HDFC Bank. He is Chief Executive Officer of the company.</p>
                </div>
            </div>
            <div class="item">
                <div class="team">
                    <div class="team_img">
                        <div class="img">
                            <img src="{{ asset('resources/frontend_assets/theme/img/team/team-3.jpg') }}" alt="">
                        </div>
                    </div>
                    <a href="#">
                        <h2>Anil Modi</h2>
                    </a>
                    <p>Anil Modi is MBA and worked in HDFC Bank for 5 years and now full time engaged in Apnagodam Venture. He belongs to an Agri Business Family.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
