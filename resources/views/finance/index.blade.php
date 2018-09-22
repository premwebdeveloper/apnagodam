@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Finance</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Finance</strong>
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
	                <h5>Finance</h5>
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
                                    <th>User</th>
                                    <th>Commodity</th>
                                    <th>Quantity</th>
                                    <th>Requested Date</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($requests as $key => $request)
                                <tr>
                                    <td>{!! $request->fname !!}</td>
                                    <td>{!! $request->commodity !!}</td>
                                    <td>{!! $request->quantity !!}</td>
                                    <td>{!! $request->created_at !!}</td>
                                    <td>                                        
                                        <a href="{{ route('request_view', ['id' => $request->id ]) }}" class="btn btn-xs btn-primary">View</a>
                                        <a href="{{ route('request_response', ['id' => $request->id ]) }}" class="btn btn-xs btn-info">Response</a>
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
