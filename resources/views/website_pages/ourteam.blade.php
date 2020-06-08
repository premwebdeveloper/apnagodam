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
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team-1.jpg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Mr. Sitaram Agarwal</b><br><i>Promoter</i></h4>
                    <p>65 years old Mr. Sitaram Agarwal has been in the Agriculture trade since last 40 Years. His objective behind this venture is to increase the holding capacity of the Seller by providing Agri warehouses near to Sellers at affordable price so that he can realize better value for his Agri produce.</p>
                </div>                
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team-2.jpg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Sanjay Agarwal</b><br><i>CEO & Founder</i></h4>
                    <p>Sanjay Agarwal is a Chartered Accountant and a Company Secretary by qualification and brings with him 11 years of experience in finance in HDFC Bank. He is the Chief Executive Officer of the company.</p>
                </div>
            </div>  

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/team3b.jpg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Anil Modi</b><br><i>COO & Co-Founder</i></h4>
                    <p>Anil Modi is an MBA and worked in HDFC Bank for 5 years and now full time engaged in Apnagodam Venture. He belongs to an Agri Business Family.</p>
                </div>                
            </div>       
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/nisha.jpeg') }}">
                    <h4 class="m-t-30 m-b-20"><b>CA Nisha Singh</b><br><i>Chief Financial Officer</i></h4>
                    <p>CA Nisha Singh is a resourceful financial professional with 8 years experience in financial management, providing leadership, direction and management of the finance and accounting team.</p>
                </div>
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/vish.jpg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Vishal Kashyap</b><br><i>Chief Technology Officer</i></h4>
                    <p>Expertise in developing the company's strategy for using technological resources, Vishal ensures technologies are used efficiently, profitably and securely. Evaluating and implementing new systems and infrastructure.</p>
                </div>

            </div>  
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/sandeep.jpeg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Sandeep Kr. Narnolia</b><br><i>Warehouse Head </i></h4>
                   <p>With over 5+ years of work experience, Sandeep oversees receiving, warehousing, distribution and maintenance operations; setting up layout and ensure efficient space utilization.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/mohan.jpeg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Mohan Choudhary</b><br>
                    <i>Operations Head</i></h4>
                    <p> Maintaining regular communication with our clients; Mohan looks after daily customer order fulfilment functions and associated processes/procedures. </p>
                </div>                
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4  m-b-30">
                <div class="col-md-12 well">                
                    <img class="w-70" src="{{ asset('resources/frontend_assets/theme/img/team/vinod.jpeg') }}">
                    <h4 class="m-t-30 m-b-20"><b>Vinod Singh Rajput</b><br><i>Sales Head</i></h4>
                   <p>Vinod plays a key role in Business Development.He along with his sales team identifies and qualifies customer opportunities for new sales.</p>
                </div>
            </div>  
        </div>
</section>
<section class="our_team_area p-40">
    <div class="container">
        <h3 class="single_title p-10">Our Mentors</h3>
        <hr class="m-0">
        <div class="col-xs-12 m-t-30 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/cutmypic.png') }}">
                <h4 class="m-t-30 m-b-20">MadhuSudan Jairath</h4>
                <p>Director at National Institute of Agricultural Marketing</p>
                
            </div> 

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/cutmypic-1.png') }}">
                <h4 class="m-t-30 m-b-20">Rajiv Bhargava</h4>
                <p>Ex Zonal Head HDFC Bank Limited</p>

            </div>  

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                
                <img class="w-50" src="{{ asset('resources/frontend_assets/img/imageedit_3_7153393447-150x150.gif') }}">
                <h4 class="m-t-30 m-b-20">Gajanand Gupta</h4>
                <p>CS & Financial Controller in Polycon International Limited</p>
                
            </div>                
        </div>
    </div> 
</section>
<style>
    .well {
        height: 550px;
    }
</style>
@endsection
