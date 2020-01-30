@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Contact Us') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Contact Us</a>
        </div>
    </div>
</section>
<section class="contact_form_area2">
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <h3 class="single_title">Location</h3>
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3556.8298847729357!2d75.7990183150455!3d26.940606983115643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db3e0cb618df7%3A0xa8be15fef1f87c60!2sApnaGodam!5e0!3m2!1sen!2sin!4v1538732548264" width="100%" height="312" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-5">
            <h3 class="single_title">Contact Details</h3>
            <div class="contact_details_inner">
                <div class="media">
                    <div class="media-left">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="media-body">
                        <p>Plot No.-16, Sector-9, Opposite Rail Vihar</p>
                        <p>Vidhyadhar Nagar Jaipur - 302039</p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="media-body">
                        <a href="mailto:sanjayagarwalcacs@gmail.com">sanjayagarwalcacs@gmail.com</a>
                        <a href="mailto:contact@apnagodam.com">contact@apnagodam.com</a>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <a href="tel:+91-9314142089">+91-9314142089</a>
                        <a href="#">0141-2232204</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
