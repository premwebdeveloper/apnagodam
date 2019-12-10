@extends('layouts.auth_app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>User's OTP</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>User's OTP</strong>
                </li>
            </ol>
        </div>
    	<div class="col-lg-6 text-right p-t-30">
            &nbsp;
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
    	        <div class="ibox float-e-margins">

    	            <div class="ibox-title">
    	                <h5>User's OTP</h5>
    	                <div class="ibox-tools">
    	                    <a class="collapse-link">
    	                        <i class="fa fa-chevron-up"></i>
    	                    </a>
    	                </div>
    	            </div>

    	            <div class="ibox-content">
                        <div class="table-responsive">
    	                    <table class="table table-striped table-bordered table-hover dataTables-example">
    	                        <thead>
    	                            <tr>
                                        <th>Mobile Number</th>
                                        <th>OTP</th>
    	                            </tr>
    	                        </thead>
    	                        <tbody>
                                    @foreach($users_otp as $key => $otp)
    	                                <tr class="gradeX">
                                            <td>{!! $otp->phone !!}</td>
                                            <td>{!! $otp->login_otp !!}</td>
    	                                </tr>
                                    @endforeach
    	                        </tbody>
    	                    </table>
    	                </div>

    	            </div>
    	        </div>
        	</div>
        </div>
    </div>    

@endsection