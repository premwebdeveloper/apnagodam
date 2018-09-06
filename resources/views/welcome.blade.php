@extends('layouts.public_app')

@section('content')

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h2 class="section-heading">Welcome to Apna Godam</h2>
                
                <hr class="margin-unset">
                <p class="mb-4">We handle complete end-to-end logistics operations for our clients from Transporting the Goods from Source to our Warehouse, Inwarding the Goods, Quality Check, Storage, Dispatch, Reporting and End Customer Delivery Transportation. 
                <p class="mb-4">With our In-House WMS and Process Management, we provide our Clients Real-Time Data of their Inventory across all locations and Daily MIS Reports of each and every Operational Activity.</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img class="max-100" src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/section-1.png') }}">
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
                        <p class="mb-4"><a href="javaScript:;">Read More</a></p>
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
                         <p class="mb-4"><a href="javaScript:;">Read More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
    <section id="clients">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-lg-push-4 text-right deskonly my-auto">
        <h2 class="section-heading">Some Of Our<br> Reputed Clients</h2>
            
            <hr class="margin-right deskonly">
            <p class="mb-4">We are currently servicing clients across the sectors of FMCG, Consumer Goods, Retail, B2B and Technology </p>  
          </div>
          
          <div class="col-lg-8 col-lg-pull-8">
            <div class="client-box">
            <div class="c-container" id="first-cbox">
                <strong>100+</strong><br>
                Clients we have<br>
                worked with
            </div>
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/nilgai.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/educomp.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/wood.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/cms.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/nisa.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/lemon.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/treebo.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/quikr.png') }}">
                </div>                
                <div class="client-container">
                    <img src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/grab.png') }}">
                </div>                

            </div>
          </div>
          
         
        </div>
      </div>
    </section>

    <section id="clients">
      <div class="container">
        <div class="row">
            <div class="col-lg-4 my-auto">
            <h2 class="section-heading">Warehouses Across <br>India</h2>
            
            <hr class="margin-unset">
            <p class="mb-4">We have dedicated and shared warehousing facilities in all the key Metro hubs across Pan-India - Mumbai, Pune, Bangalore, Delhi-NCR, Kolkata, Chennai, Hyderabad, Lucknow. Apart from these, we have partner warehouse space in Tier-2 and Tier-3 cities to provide a wider reach of logistics to our clients.</p>  
            </div>
          
            <div class="col-lg-8 text-center text-lg-right">
                <img class="max-100" src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/map.png') }}">
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
                    <p>Our objective is to Reduce our clients overall Logistics Cost and Increase their Customer Order Servicability</p>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light mt-4">
        <div class="row pb-2">
            <div class="col-lg-6l px-0">
                <img class="full-100 p-4 p-lg-0" src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/strenght.png') }}" style="width: 91%;height: 500px;">
            </div>          

            <div class="col-lg-6s my-auto text-lg-center px-0">
                <div class="iblock px-5">
                    <h2 class="text-left section-heading">Our Strength</h2>
                    
                    <ul class="text-left">
                        <li>Pan India network of warehouses covering each region</li>   
                        <li>Multi-user and shared Warehouse Facility</li>
                        <li>Flexible Warehousing Model</li>
                        <li>System & Process Driven Organization</li>
                        <li>Experinced team in running operations across multiple sectors like: FMCG, Retail, E-Comm, Technology etc. </li>         
                    </ul>
                </div> 
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-lg-6l col-lg-push-6l px-0">
                <img class="full-100 p-4 p-lg-0" src="{{ asset('resources/frontend_assets/d289689kksgoaf.cloudfront.net/img/benifits.png') }}">
            </div>    
            <div class="col-lg-6s col-lg-pull-6s my-auto text-lg-center px-0">
                <div class="iblock px-5">
                <h2 class="text-left section-heading">Customer Benefits</h2>
                
                <ul class="text-left">
                    <li>Distribution & Delivery in any Tier-1 and Tier-3 cities within 24 hours</li>    
                    <li>Lower Inventory Holding and Handling cost</li>
                    <li>Effective use of warehouse space during peak and non-peak seasons and order level</li>
                    <li>Fixed SLA & KPI for managing inventory and Dispactches, Real-time update of inventory stock</li>
                    <li>Continous focus on Process Improvment and cost Efficiency</li>          
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
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/dna.png"> <span class="iblock bline">&nbsp; DNA India</span>
    </div>
  <div class="item">
    <p class="pb-2">ApnaGodam raises 1.92cr in a seed-round of funding from a group of angel investors.</p>
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/economic-times.jpg"> <span class="iblock bline">&nbsp; Economic Times</span>
  
  </div>
  <div class="item">
    <p class="pb-2">India's ApnaGodam Wants To Be The DropBox For Physical Storage</p>
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/inc-42.jpg"> <span class="iblock bline">&nbsp; INC42.</span>
  
  </div>
  <div class="item">
    <p class="pb-2">Out of the box thinking - startup ApnaGodam stores your belongings till you want them back</p>
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/your-story.jpg"> <span class="iblock bline">&nbsp; Your Story</span>
  
  </div>
  <div class="item">
    <p class="pb-2">What an idea - Box My Space works on the same lines except that they also do the transferring for you.</p>
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/asian-age.jpg"> <span class="iblock bline">&nbsp; Asian Age</span>
  
  </div>
  <div class="item">
  <p class="pb-2">Storing everything away in a box has created so much space at home and my stuff stays accessible too.</p>
    <img class="iblock bline" src="d289689kksgoaf.cloudfront.net/img/ht.jpg"> <span class="iblock bline">&nbsp; Hindustan Times</span>
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
    
    <section id="counter">
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
    </section>  
</main> 
<!-- Page Content Ends -->

@endsection
