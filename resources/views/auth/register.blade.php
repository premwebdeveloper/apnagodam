@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Registration') }}</h3>
        </div>
        <div class="pull-right">
            <a href="{{ url('/') }}">Home</a>
            <a>Registration</a>
        </div>
    </div>
</section>
<section class="contact_form_area">
    <div class="container">
        <div class="main_title">
            <h5>GET STARTED</h5>
            <h2>Registration</h2>
        </div>
        <div class="row contact_form_inner">
            <div class="col-md-6 text-center">
                <h3 class="c_inner_title">Register as Seller</h3>
                <div class="form-group col-md-12 button_area">
                    <a href="{{ route('farmer_register') }}" value="submit your quote" class="btn submit_blue form-control" id="js-contact-btn">Register <i class="fa fa-angle-right"></i></a>
                    <div id="js-contact-result" data-success-msg="Success, We will get back to you soon" data-error-msg="Oops! Something went wrong"></div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <h3 class="c_inner_title">Register as Buyer</h3>
                <div class="form-group col-md-12 button_area">
                    <a href="{{ route('trader_register') }}" value="submit your quote" class="btn submit_blue form-control" id="js-contact-btn">Register <i class="fa fa-angle-right"></i></a>
                    <div id="js-contact-result" data-success-msg="Success, We will get back to you soon" data-error-msg="Oops! Something went wrong"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
