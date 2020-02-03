@extends('layouts.auth_app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Mandi Samiti</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>Mandi Samiti</strong>
                </li>
            </ol>
        </div>
    	<div class="col-lg-6 text-right p-t-30">
            <a href="{{ route('add_mandi_samiti') }}" class="btn btn-info">Add Mandi Samiti</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
    	        <div class="ibox float-e-margins">

    	            <div class="ibox-title">
    	                <h5>Mandi Samiti</h5>
    	                <div class="ibox-tools">
    	                    <a class="collapse-link">
    	                        <i class="fa fa-chevron-up"></i>
    	                    </a>
    	                </div>
    	            </div>

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

    	            <div class="ibox-content">
                        <div class="table-responsive">
    	                    <table class="table table-striped table-bordered table-hover dataTables-example">
    	                        <thead>
    	                            <tr>
                                        <th>#</th>
                                        <th>KUMS Name</th>
                                        <th>Class</th>
                                        <th>Secretary Name</th>
                                        <th>Mobile No.</th>
                                        <th>STD Code</th>
                                        <th>Tel. No.</th>
                                        <th>Fax</th>
                                        <th>Email</th>
                                        <!-- <th>Address</th>
                                        <th>District</th> -->
                                        <th>Action</th>
    	                            </tr>
    	                        </thead>
    	                        <tbody>
                                    @foreach($mandi_samiti as $key => $samiti)
    	                                <tr>
                                            <td>{!! ++$key !!}</td>
                                            <td>{!! $samiti->name !!}</td>
                                            <td>{!! $samiti->class !!}</td>
                                            <td>{!! $samiti->secretary_name !!}</td>
                                            <td>{!! $samiti->phone !!}</td>
                                            <td>{!! $samiti->std_code !!}</td>
                                            <td>{!! $samiti->tel_no !!}</td>
                                            <td>{!! $samiti->fax !!}</td>
                                            <td>{!! $samiti->email !!}</td>
                                            <!-- <td>{!! $samiti->address !!}</td>
                                            <td>{!! $samiti->district !!}</td> -->
                                            <td>
                                                <a href="{!! route('edit_mandi_samiti', ['id' => $samiti->id]) !!}" class="btn btn-primary btn-xs" title="Edit">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="{!! route('delete_mandi_samiti', ['id' => $samiti->id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Mandi Samiti">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
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