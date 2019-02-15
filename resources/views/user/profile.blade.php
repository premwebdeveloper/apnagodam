@extends('layouts.public_app')

@section('content')
<style>
    .py-4{
        padding-top: 0rem!important;
    }
    .masthead{
        height: 20vh!important;
        min-height: 140px!important;
    }
</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">

                <h2 class="section-heading text-center">Profile</h2>
                <hr>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Phone</th>
                            <th scope="col">Name</th>
                            <th scope="col">Father Name</th>
                            @if(!empty($user->gst_number))
                                <th scope="col">GST Number</th>
                            @else
                                <th scope="col">Khasra Number</th>
                            @endif
                            <th scope="col">Village</th>
                            <th scope="col">Tehsil</th>
                            <th scope="col">District</th>
                            <th scope="col">Power</th>
                            <th scope="col">Image</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->father_name }}</td>
                            @if(!empty($user->gst_number))
                                <td>{{ $user->gst_number }}</td>
                            @else
                                <td>{{ $user->khasra_no }}</td>
                            @endif
                            <td>{{ $user->village }}</td>
                            <td>{{ $user->tehsil }}</td>
                            <td>{{ $user->district }}</td>
                            <td>{{ $user->power }}</td>
                            <td>
                                <img alt="image" class="img-responsive" src="{{ asset('resources/assets/upload/profile_image/'.$user->image) }}" style="width:75px;">
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- <section id="services">
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

                            <div class="col-lg-6 col-md-6 text-center">
                                <div class="service-box mt-5 mx-auto" style="background: #012b72;">
                                    <i class="fa fa-rupee-sign" style="color:#fff"></i>
                                    <h4 class="mb-2" style="color:#fff">Financing</h4>
                                     <p class="mb-4"><a href="{{ route('user_finance_view') }}" style="color:#fff">Click Here</a></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 text-center">
                                <div class="service-box mt-5 mx-auto">
                                    <i class="fab fa-buysellads"></i>
                                    <h4 class="mb-2">Buy and Sell</h4>
                                     <p class="mb-4"><a href="{{ route('buy_sell') }}">Click Here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->
            </div>

        </div>
    </div>
</section>

@endsection