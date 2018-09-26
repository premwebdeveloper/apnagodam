@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Finance Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('finance') }}">Finances</a>
            </li>
            <li class="active">
                <strong>Finance Details</strong>
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
	                <h5>Finance Details</h5>
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
	                        <tbody>
                                <tr>
                                    <td>User</td>
                                    <td>{!! $request->fname !!}</td>
                                    <td>Commodity</td>
                                    <td>{!! $request->commodity !!}</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{!! $request->quantity !!}</td>
                                    <td>Requested Date</td>
                                    <td>{!! $request->created_at !!}</td>
                                </tr>
                                <tr>
                                    <td>Bank Namw</td>
                                    <td>{!! $request->bank_name !!}</td>
                                    <td>Branch Name</td>
                                    <td>{!! $request->branch_name !!}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>{!! $request->acc_number !!}</td>
                                    <td>IFSC Code</td>
                                    <td>{!! $request->ifsc !!}</td>
                                </tr>
                                <tr>
                                    <td>PAN Card</td>
                                    <td>
                                        <a href="{!! asset('resources/assets/upload/pancards/'.$request->user_id.'/'.$request->pan) !!}" alt="{!! $request->pan !!}" target="_blank" download> 
                                            <img src="{!! asset('resources/assets/upload/pancards/'.$request->user_id.'/'.$request->pan) !!}" alt="{!! $request->pan !!}" style="width:100px;">
                                        </a>
                                    </td>
                                    <td>AADHAR Card</td>
                                    <td>
                                        <a href="{!! asset('resources/assets/upload/pancards/'.$request->user_id.'/'.$request->aadhar) !!}" alt="{!! $request->aadhar !!}" target="_blank" download> 
                                            <img src="{!! asset('resources/assets/upload/aadharcards/'.$request->user_id.'/'.$request->aadhar) !!}" alt="{!! $request->aadhar !!}" style="width:100px;">
                                        </a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Balance Sheet</td>
                                    <td>
                                        <a href="{!! asset('resources/assets/upload/pancards/'.$request->user_id.'/'.$request->balance_sheet) !!}" alt="{!! $request->balance_sheet !!}" target="_blank" download> 
                                            <img src="{!! asset('resources/assets/upload/balancesheets/'.$request->user_id.'/'.$request->balance_sheet) !!}" alt="{!! $request->balance_sheet !!}" style="width:100px;">
                                        </a>
                                    </td>
                                    <td>Bank Statement</td>
                                    <td>
                                        <a href="{!! asset('resources/assets/upload/bankstatements/'.$request->user_id.'/'.$request->bank_statement) !!}" alt="{!! $request->bank_statement !!}" target="_blank" download> 
                                            <img src="{!! asset('resources/assets/upload/bankstatements/'.$request->user_id.'/'.$request->bank_statement) !!}" alt="{!! $request->bank_statement !!}" style="width:100px;">
                                        </a>
                                    </td>
                                </tr>
	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
