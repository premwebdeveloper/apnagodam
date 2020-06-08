@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Membership') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Membership</a>
        </div>
    </div>
</section>
<section class="contact_form_area2">
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <h3 class="single_title">Become a Member</h3>
                <p>Apnagodam is an e-market Sub-Yard notified by the Goverment of Rajasthan. This portal is set up to provide an online trading platform for spot trading in various agriculture and non-agriculture commodities. Click here to view the membership form.</p><br/><br/>
                <a class="quote_btn" download href="<?= asset('resources/frontend_assets/uploads/memberhsip_application_form.doc'); ?>">Download Form</a>
            </div>
        </div>
        <div class="col-md-5">
            <img src="<?= asset('resources/frontend_assets/img/membership.png'); ?>">
        </div>
    </div>
</div>
</section>
@endsection
