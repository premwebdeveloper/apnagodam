@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>My Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Profile</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h5>Profile</h5>
	            </div>
	            <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget btn-success p-xl">
                                <h2 class="col-md-6 p-0">
                                    <b>{{ $employee->first_name }} {{ $employee->last_name }}</b>
                                </h2>
                                <h2 class="col-md-6 p-0 text-right">
                                    Employee ID : <b>{{ $employee->emp_id }}</b>
                                </h2><br/><br/>
                                <ul class="list-unstyled m-t-md">
                                    <li class="p-t-20">
                                        <h3 class="font-bold no-margins">
                                            <span class="fa fa-envelope m-r-xs"></span>
                                            <label>Email: </label>
                                            {{ $employee->email }}
                                        </h3>
                                    </li>
                                    <li class="p-t-20">
                                        <h3 class="font-bold no-margins">
                                            <span class="fa fa-home m-r-xs"></span>
                                            <label>Designation: </label>
                                            {{ $employee->designation }}
                                        </h3>
                                    </li>
                                    <li class="p-t-20">
                                        <h3 class="font-bold no-margins">
                                            <span class="fa fa-phone m-r-xs"></span>
                                            <label>Contact: </label>
                                            {{ $employee->phone }}
                                        </h3>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
	            </div>
	        </div>
    	</div>
    </div>
</div>

@endsection
