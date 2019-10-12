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
                            <th>Phone</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            @if(!empty($user->gst_number))
                                <th>GST Number</th>
                            @else
                                <th>Khasra Number</th>
                            @endif
                            <th>Village</th>
                            <th>Tehsil</th>
                            <th>District</th>
                            <th>Power</th>
                            <th>Referral Code</th>
                            <th>Image</th>
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
                            <td>{{ $user->referral_code }}</td>
                            <td>
                                <img alt="image" class="img-responsive" src="{{ asset('resources/assets/upload/profile_image/'.$user->image) }}" style="width:75px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection