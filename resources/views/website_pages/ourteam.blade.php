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
                <h2 class="section-heading text-center">{{ __('Our Team') }}</h2>
                <hr>
                <br>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4 apna">
                            <img class="max-100" src="{{ asset('resources/frontend_assets/img/tuxpi.com_.1473761681.jpg') }}">
                        </div>                   
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-8 apna">
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Mr. Sitaram agarwal</h4>
                                <p class="text-justify">63 years old is the promoter of the Company. He has been in the Agriculture  trade since last 40 Years.  The objective behind this venture is to increase the holding capacity of the farmer by providing  Agri warehouses near to farmers at affordable price so that he can realize better value for his Agri produce.</p>
                            </div>
                        </div>                    
                    </div>                 
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4 apna">
                            <img class="max-100" src="{{ asset('resources/frontend_assets/img/Sanjay Agarwal.jpg') }}" style="    border-radius: 50%;">
                        </div>                   
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-8 apna">
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Mr. Sanjay Agarwal</h4>
                                <p class="text-justify">Sanjay Agarwal  is a chartered accountant and a company secretary by qualification and brings with him 11 years of experience in finance in HDFC Bank. He is Chief Executive Officer of the company.</p>
                            </div>
                        </div>                    
                    </div>                 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4 apna">
                            <img class="max-100" src="{{ asset('resources/frontend_assets/img/anil_modi.jpg') }}" style="    border-radius: 50%;">
                        </div>                   
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-8 apna">
                            <div class="s-content">
                                <h4 class="centered s-main osLight">Anil Modi</h4>
                                <p class="text-justify">Anil Modi is MBA and worked in HDFC Bank for 5 years and now full time engaged in Apnagodam Venture. He belongs to an Agri Business Family.</p>
                            </div>
                        </div>                    
                    </div>                                  
                </div> 
                <br><br><br>
                <h2 class="section-heading text-center">{{ __('Our Mentors') }}</h2>
                <hr>
                <br> 
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                        
                        <img class="max-100" src="{{ asset('resources/frontend_assets/img/cutmypic.png') }}" style="    border-radius: 50%;width: 150px;height: 150px;">
                        <h4 class="centered s-main osLight">MadhuSudan Jairath</h4>
                        <p>Director at National Institute of<br> Agricultural Marketing</p>
                        
                    </div> 

                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                        
                        <img class="max-100" src="{{ asset('resources/frontend_assets/img/cutmypic-1.png') }}" style="    border-radius: 50%;width: 150px;height: 150px;">
                        <h4 class="centered s-main osLight">Rajiv Bhargava</h4>
                        <p>EX Zonal Head HDFC Bank Limited</p>

                    </div>  

                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">
                        
                        <img class="max-100" src="{{ asset('resources/frontend_assets/img/imageedit_3_7153393447-150x150.gif') }}" style="border-radius: 50%;width: 150px;height: 150px;">
                        <h4 class="centered s-main osLight">Gajanand Gupta</h4>
                        <p>Company Secretary and financial controller<br> in Polycon International Limited</p>
                        
                    </div>                
                </div>              
            </div>
        </div>
    </div>
</section>
@endsection
