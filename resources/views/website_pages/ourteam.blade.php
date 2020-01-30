@extends('layouts.public_app')

@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Our Team') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Our Team</a>
        </div>
    </div>
</section>
<section class="our_team_area p-40">
    <div class="container">
        <h3 class="single_title p-10">Our Team</h3>
        <hr class="m-0">
        <div class="col-xs-12 m-t-30 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team1.jpg') }}">
                <h4 class="m-t-30 m-b-20">Mr. Sitaram Agarwal</h4>
                <p>65 years old is the promoter of the Company. He has been in the Agriculture trade since last 40 Years. The objective behind this venture is to increase the holding capacity of the Seller by providing Agri warehouses near to Sellers at affordable price so that he can realize better value for his Agri produce.</p>
                
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team2.jpg') }}">
                <h4 class="m-t-30 m-b-20">Sanjay Agarwal</h4>
                <p>Sanjay Agarwal is a chartered accountant and a company secretary by qualification and brings with him 11 years of experience in finance in HDFC Bank. He is Chief Executive Officer of the company.</p>

            </div>  

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team-3.jpg') }}">
                <h4 class="m-t-30 m-b-20">Anil Modi</h4>
                <p>Anil Modi is MBA and worked in HDFC Bank for 5 years and now full time engaged in Apnagodam Venture. He belongs to an Agri Business Family.</p>
                
            </div>                
        </div>
    </div>
</section>
<section class="our_team_area p-40">
    <div class="container">
        <h3 class="single_title p-10">Our Mentors</h3>
        <hr class="m-0">
        <div class="col-xs-12 m-t-30 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/cutmypic.png') }}">
                <h4 class="m-t-30 m-b-20">MadhuSudan Jairath</h4>
                <p>Director at National Institute of<br> Agricultural Marketing</p>
                
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/cutmypic-1.png') }}">
                <h4 class="m-t-30 m-b-20">Rajiv Bhargava</h4>
                <p>EX Zonal Head HDFC Bank Limited</p>

            </div>  

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/imageedit_3_7153393447-150x150.gif') }}">
                <h4 class="m-t-30 m-b-20">Gajanand Gupta</h4>
                <p>Company Secretary and financial controller<br> in Polycon International Limited</p>
                
            </div>                
        </div>
    </div>
</section>
@endsection
