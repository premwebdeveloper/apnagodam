@extends('layouts.public_app')

@section('content')

<main id="main"> <!-- main body conatiner starts-->
    <header class="">
        <link href="http://aashiholidays.com/css/responsive-slider.css" rel="stylesheet"> 
        <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
            <div class="slides apna_godam1" data-group="slides">
                <ul>
                    
                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner1.png') }}">              
                        </div>
                    </li>
                    
                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner2.png') }}">              
                        </div>
                    </li>
                    
                    <li>
                        <div class="slide-body" data-group="slide">
                            <img src="{{ asset('resources/frontend_assets/img/banner3.png') }}">              
                        </div>
                    </li>
                </ul>
            </div>
           <!-- <a class="slider-control left" href="#" data-jump="prev">Prev</a>
            <a class="slider-control right" href="#" data-jump="next">Next</a>-->
        </div>
        <script src="http://aashiholidays.com/js/jquery.event.move.js"></script>
        <script src="http://aashiholidays.com/js/responsive-slider.js"></script>
    </header>
<!-- 
    <section id="cta">
    <a style="margin-top:-125px" href="javascript:;" class="big-cta text-white">
        <div class="iblock">Enquire Now</div>
        <div class="iblock pl-4">
            <img src="{{ asset('resources/frontend_assets/img/right-arrow.png') }}">
        </div>
    </a>  
    </section> -->

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h2 class="section-heading">Welcome to Apna Godam</h2>
                
                <hr class="margin-unset">
                <p class="mb-4"><b>“An exclusive portal in Agri Warehousing which connects farmers / traders with the godown owners “</b></p>
                <p class="mb-4">
                There are old sheds / buildings and storage areas which are lying idle / vacant and at the same time the farmers / traders in that area are sending their Agri produce for storage at distant area after incurring huge cost on transportation.</p>
                <p class="mb-4">
                Apna Godam  is a platform to connect both and hence the idle assets are put to use and the Agri produce is preserved as well.</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img class="max-100" src="{{ asset('resources/frontend_assets/img/section-1.png') }}">
                </div>
            </div>
        </div>
    </section>

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
                        <i class="fa fa-warehouse"></i>
                        <h4 class="mb-2">Warehousing Services</h4>
                        <p class="mb-4"><a href="{{ route('register') }}">Read More</a></p>
                    </div>
                </div>
             
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box mt-5 mx-auto" style="background: #012b72;">
                        <i class="fa fa-rupee-sign" style="color:#fff"></i>
                        <h4 class="mb-2" style="color:#fff">Financing</h4>
                         <p class="mb-4"><a href="javaScript:;" style="color:#fff">Read More</a></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="service-box mt-5 mx-auto">
                        <i class="fab fa-buysellads"></i>
                        <h4 class="mb-2">Buy and Sell</h4>
                         <p class="mb-4"><a href="{{ route('buy_sell') }}">Read More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--     <section id="clients">
      <div class="container">
        <div class="row">
            <div class="col-lg-4 my-auto">
            <h2 class="section-heading">Warehouses Across <br>India</h2>
            
            <hr class="margin-unset">
            <p class="mb-4">We have dedicated and shared warehousing facilities in all the key Metro hubs across Pan-India - Mumbai, Pune, Bangalore, Delhi-NCR, Kolkata, Chennai, Hyderabad, Lucknow. Apart from these, we have partner warehouse space in Tier-2 and Tier-3 cities to provide a wider reach of logistics to our clients.</p>  
            </div>
          
            <div class="col-lg-8 text-center text-lg-right">
                <img class="max-100" src="{{ asset('resources/frontend_assets/img/map.png') }}">
            </div>
        </div>
      </div>
    </section> -->
    
    <section id="why-us">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-lg-auto text-lg-center">
                    <h2 class="section-heading">Why Apna Godam</h2>
                    <hr class="my-4 mob-left">
                    <p>We remove inefficiency in the entire supply chain and save cost to the farmers</p>
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
                        <li>Warehouses NEAR FARM</li>   
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
                <h2 class="text-left section-heading">Customer Benefits</h2>
                
                <ul class="text-left">
                    <li>Low transportation cost as the warehouse is nearby</li>    
                    <li>Just send the commodity in warehouse and relax , everything is online</li>
                    <li>Proper Fumigations and spray to keep the commodity safe</li>
                    <li>Millers on board to purchase the commodity from warehouses</li>
                    <li>Grading / sorting facility in some warehouses</li>          
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
                <h2 class="section-heading text-center text-md-left">Featured<br>
                in print media</h2>
                <hr class="mx-lg-0 mx-auto">
              </div>
            </div>
            <div class="col-md-9">
            
            <div id="featured-caro" class="owl-carousel">
              <div class="item">
                <p class="pb-2">Box My Space, is allocating space crunch substitutes to those who need it the most</p>
                <img class="iblock bline" src="img/dna.png"> <span class="iblock bline">&nbsp; DNA India</span>
                </div>
              <div class="item">
                <p class="pb-2">ApnaGodam raises 1.92cr in a seed-round of funding from a group of angel investors.</p>
                <img class="iblock bline" src="img/economic-times.jpg"> <span class="iblock bline">&nbsp; Economic Times</span>
              
              </div>
              <div class="item">
                <p class="pb-2">India's ApnaGodam Wants To Be The DropBox For Physical Storage</p>
                <img class="iblock bline" src="img/inc-42.jpg"> <span class="iblock bline">&nbsp; INC42.</span>
              
              </div>
              <div class="item">
                <p class="pb-2">Out of the box thinking - startup ApnaGodam stores your belongings till you want them back</p>
                <img class="iblock bline" src="img/your-story.jpg"> <span class="iblock bline">&nbsp; Your Story</span>
              
              </div>
              <div class="item">
                <p class="pb-2">What an idea - Box My Space works on the same lines except that they also do the transferring for you.</p>
                <img class="iblock bline" src="img/asian-age.jpg"> <span class="iblock bline">&nbsp; Asian Age</span>
              
              </div>
              <div class="item">
              <p class="pb-2">Storing everything away in a box has created so much space at home and my stuff stays accessible too.</p>
                <img class="iblock bline" src="img/ht.jpg"> <span class="iblock bline">&nbsp; Hindustan Times</span>
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
    
<!--     <section id="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="weight400 text-main text-big">Space (Sq.ft) we have available across pan-india</p>
                    <h1 class="text-primary text-huge timer count-title count-number"><span id="count" class="counter">5,34,700</span>+</h1>                  
                </div>
            </div>
        </div> 
    </section>
    
    <section class="cta-bg">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-5 mx-auto text-white text-center py-3 my-3 py-lg-5 my-lg-5">
                    <p class="text-big pb-4">Are you a manufaturer retailer or E&#8209;Commerce Company.</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="javascript:;">Enquire Now</a>
                </div>
            </div>
        </div>
    </section>   -->
</main> 
<!-- Page Content Ends -->

@endsection
