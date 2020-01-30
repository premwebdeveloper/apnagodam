@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('FAQs') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">FAQs</a>
        </div>
    </div>
</section>
<section class="price_faq_area">
    <div class="container">
        <div class="main_title">
            <h5>Faq</h5>
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="faq_question_list">
                    <div class="faq_item">
                        <h4>What is Apnagodam.com ?</h4>
                        <p>ApnaGodam is a Jaipur based Agritech Startup providing warehousing facilities and online commodity financing to farmers all across India. In addition to this, ApnaGodam facilitates an online marketplace where  farmers, traders and buyers can trade online in agricultural  commodities. The trade settlement is backed by financial security from the buyer and stocks of the seller.</p>
                    </div>
                    <div class="faq_item">
                        <h4>How can I register on apnagodam.com?</h4>
                        <p>To register,kindly call us on our IVR no. 7733901154 or write to us on contact@apnagodam.com with your name/firm name, address, email address and your phone number and we will reach out to you.</p>
                    </div>
                    <div class="faq_item">
                        <h4>As a seller, how can I be sure of my quality parameters ?</h4>
                        <p>Sellers can choose to certify their produce by calling us on our helpline no.  and we will coordinate the same. In case, there is a dispute on tested quality, Apnagodam  guarantees you a complete protection from quality and quantity deductions at the time of lifting.</p>
                    </div>                        
                    <div class="faq_item">
                        <h4>What are the documents required to register?</h4>
                        <p>We require basic KYC documents (Aadhar Card, PAN card address proof, taxation details and bank account details) of yours and your firm for the registration.</p>
                    </div>      
                     <div class="faq_item">
                        <h4>Does it cost to get registered?</h4>
                        <p>Not at all. Registration on Apnagodam is absolutely free.</p>
                    </div>                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="faq_question_list">
                    <div class="faq_item">
                        <h4>Why do you need my bank account details?</h4>
                        <p>Once a trade is complete on apnagodam.com and the commodity delivery is acknowledged by the buyer, Apnagodam transfers the payment into the seller’s bank account with 24 hours.</p>
                    </div>
                    <div class="faq_item">
                        <h4>How can seller create a new order on the platform ?</h4>
                        <p>After you login with your mobile number and OTP  received on your registered mobile no. you can go to your  panel, and create an order under My Sell tab. You can select the quantity of your commodity, quality, location, price and duration of the trade. </p>
                    </div>
                    <div class="faq_item">
                        <h4>How can buyer create a new order on the platform ?</h4>
                        <p>After you login with your mobile number and OTP  received on your registered mobile no. you can go to your  panel, view the commodities available for bidding in the Market tab, place your bid , wait for approval and complete your purchase. </p>
                    </div>
                    <div class="faq_item">
                        <h4>When will I receive the payment?</h4>
                        <p>As soon as the commodity delivery is acknowledged by the buyer and Apnagodam personnel (in any case less than 24 hours), the payment will be transferred straight to the seller’s bank account.</p>
                    </div>
                    <div class="faq_item">
                        <h4>What are the quality norms for the platform ?</h4>
                        <p>Apnagodam provides testing and certification facility through its empanelled collateral managers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
