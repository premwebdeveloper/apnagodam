@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Terminals</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Terminals</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('add_warehouse_view') }}" class="btn btn-info">Add Terminal</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Terminals</h5>
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
                                    <th>Mandi Samiti Name</th>
                                    <th>Terminal Code</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>District</th>
                                    <th>Area (SQ. FT.)</th>
                                    <th>Rent (/Month)</th>
                                    <th>Capacity (MT)</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($warehouses as $key => $warehouse)
	                                <tr class="gradeX">
                                        <td>{!! $warehouse->mandi_samiti_name !!}</td>
                                        <td>{!! $warehouse->warehouse_code !!}</td>
                                        <td>{!! $warehouse->name !!}</td>
                                        <td>{!! $warehouse->address !!}</td>
                                        <td>{!! $warehouse->district !!}</td>
                                        <td>{!! $warehouse->area_sqr_ft !!}</td>
                                        <td>{!! $warehouse->rent_per_month !!}</td>
                                        <td>{!! $warehouse->capacity_in_mt !!}</td>                                        
                                        <td>
                                            <a href="{!! route('warehouse_view', ['id' => $warehouse->id]) !!}" class="btn btn-info btn-sm" title="View">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                                            <a href="{!! route('warehouse_edit_view', ['id' => $warehouse->id]) !!}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('warehouse_delete', ['id' => $warehouse->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete Terminal">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            @endif
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
