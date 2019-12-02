@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Enquiries</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Enquiries</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Enquiries</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Phone</th>
                                    <th>Warehouse Name</th>
                                    <th>Commodity Name</th>
                                    <th>Quantity</th>
                                    <th>Commitment(In Months)</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($enquiries as $key => $enquiry)
	                                <tr class="gradeX">
                                        <td>{!! $enquiry->mobile !!}</td>
                                        <td>{!! $enquiry->name !!}</td>
                                        <td>{!! $enquiry->category_name !!}</td>
                                        <td>{!! $enquiry->quantity !!}</td>
                                        <td>{!! $enquiry->commitment !!}</td>
                                        <td><!-- 
                                            <a href="{!! route('approve', ['id' => $enquiry->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="top" title="Approve Enquiry">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a> -->
                                            <a href="{!! route('unapprove', ['id' => $enquiry->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete Enquiry">
                                                <i class="fa fa-times" aria-hidden="true"></i>
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
