@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Terminal Enquires</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Terminal Enquires</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Terminal Enquires</h5>
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
                                    <th>Terminal Name</th>
                                    <th>Commodity</th>
                                    <th>Quantity (Ton)</th>
                                    <th>Mobile Number</th>
                                    <th>Commitment (Time Period in Months)</th>
                                    <th>Date</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($warehouses as $key => $warehouse)
	                                <tr class="gradeX">
                                        <td>{!! $warehouse->name !!}</td>
                                        <td>{!! $warehouse->commodity_name !!}</td>
                                        <td>{!! $warehouse->quantity !!}</td>
                                        <td>{!! $warehouse->mobile !!}</td>
                                        <td>{!! $warehouse->commitment !!}</td>
                                        <td><?php echo date('d-m-Y', strtotime($warehouse->created_at)) ?></td>
                                        <td>
                                            <a href="{!! route('delete_terminal_enquiry', ['enquiry_id' => $warehouse->id]) !!}" class="btn btn-info btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Enquiry">
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
