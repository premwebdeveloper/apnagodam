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

                <h2 class="section-heading">Change Password</h2>
                <br>
                <div class="col-lg-6">
            
                    <div class="lead-form pt-2">
                    
                        <form name="ContactForm" method="post" action="{{ route('change_password') }}" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password:</label>
                                <input required="" type="password" class="form-control form-validate" name="old_password" placeholder="Old Password:">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password:</label>
                                <input required="" type="password" class="form-control form-validate" name="new_password" placeholder="New Password:">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password:</label>
                                <input required="" type="password" class="form-control form-validate" name="cfm_password" placeholder="Confirm Password:">
                            </div>
                            <input type="submit" value="Submit Request" class="form-control form-submit">  
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection