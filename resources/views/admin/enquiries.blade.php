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
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    <th>Category</th>
                                    <th>Khasra Number</th>
                                    <th>GST Number</th>
                                    <th>Village</th>
                                    <th>Tehsil</th>
                                    <th>District</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($enquiries as $key => $enquiry)
	                                <tr class="gradeX">
                                        <td>{!! $enquiry->phone !!}</td>
                                        <td>{!! $enquiry->fname !!}</td>
                                        <td>{!! $enquiry->father_name !!}</td>
                                        @if($enquiry->category==1)
                                        <td>Seller</td>
                                        @elseif($enquiry->category==2)
                                        <td>Buyer</td>
                                        @elseif($enquiry->category==3)
                                        <td>Miller</td>
                                        @endif
                                        
                                        <td>{!! $enquiry->khasra_no !!}</td>
                                        
                                        <td>{!! $enquiry->gst_number !!}</td>
                                        
                                        <td>{!! $enquiry->village !!}</td>
                                        <td>{!! $enquiry->tehsil !!}</td>
                                        <td>{!! $enquiry->district !!}</td>
                                        <td>
                                            <a href="{!! route('approve', ['user_id' => $enquiry->user_id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="top" title="Approve Enquiry">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('unapprove', ['user_id' => $enquiry->user_id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Unapprove Enquiry">
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
