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
                <h2 class="section-heading text-center">{{ __('Contact Us') }}</h2>
                <hr>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3556.8298847729357!2d75.7990183150455!3d26.940606983115643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db3e0cb618df7%3A0xa8be15fef1f87c60!2sApnaGodam!5e0!3m2!1sen!2sin!4v1538732548264" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                <br>
                <br>
                <p><i class="fa fa-map-marker"></i> Plot No.-16, Sector-9, Opposite Rail Vihar, Vidhyadhar Nagar Jaipur</p>
                <p><i class="fa fa-envelope"></i> <a href="mailto:sanjayagarwalcacs@gmail.com">sanjayagarwalcacs@gmail.com</a></p>
                <p><i class="fa fa-phone"></i> <a href="tel:+91-9314142089">+91-9314142089</a></p>

            </div>
        </div>
    </div>
</section>
@endsection
