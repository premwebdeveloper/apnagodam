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

                <h2 class="section-heading text-center">Notifications</h2>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Phone</th>
                            <th scope="col">Name</th>
                            <th scope="col">Father Name</th>
                            <th scope="col">Village</th>
                            <th scope="col">Tehsil</th>
                            <th scope="col">District</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123</td>
                            <td>12</td>
                            <td>132</td>
                            <td>132</td>
                            <td>5415</td>
                            <td>415</td>
                        </tr>
                    </tbody>
                </table>
            
                <hr>
            </div>

        </div>
    </div>
</section>

@endsection