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
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Terminal Name</th>
                                    <th>Commodity</th>
                                    <th>Quantity</th>
                                    <th>Mobile Number</th>
                                    <th>Commitment</th>
                                    <th>Date</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($warehouses as $key => $warehouse)
	                                <tr class="gradeX">
                                        <td>{!! $warehouse->name !!}</td>
                                        <td>{!! $warehouse->commodity !!}</td>
                                        <td>{!! $warehouse->quantity !!}</td>
                                        <td>{!! $warehouse->mobile !!}</td>
                                        <td>{!! $warehouse->commitment !!}</td>
                                        <td><?php echo date('d-m-Y', strtotime($warehouse->created_at)) ?></td>
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
