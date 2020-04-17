@extends('layouts.auth_app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All Corporate Buyers </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Corporate Buyer </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create Corporate Buyer</h5>
                </div>
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'addCorporateUser', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                            <div class="col-md-4">
                                {!! Form::label('user_id', 'Buyer', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('user_id', $customers, '', ['class' => 'form-control', 'id' => 'customer', 'required' => 'required']); !!}
                                @if($errors->has('user_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('pincode', 'Pin Code', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('pincode', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Pin Code']) !!}

                                @if($errors->has('pincode'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('price', 'Price', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('price', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Price']) !!}

                                @if($errors->has('price'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- <div class="col-md-4">
                                {!! Form::label('transport_cost', 'Transport Cost / KM', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('transport_cost', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Transport Cost / KM']) !!}
                            
                                @if($errors->has('transport_cost'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('transport_cost') }}</strong>
                                    </span>
                                @endif
                            </div> -->
                            <div class="col-md-4">
                                {!! Form::label('terminal_id', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('terminal_id', $terminals, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                @if($errors->has('terminal_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('terminal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 m-t-25">
                                {!! Form::submit('Add Corporate Buyer', ['class' => 'btn btn-info form-control b-info', 'onclick' => 'submitForm(this);']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Buyers List</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example1">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Buyer Name</th>
                                    <th>Terminal</th>
                                    <th>Price</th>
                                    <th>Pincode</th>
                                    <th>Location</th>
                                    <th>Transport Cost / KM</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $lead)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $lead->user_name !!}</td>
                                        <td>{!! $lead->terminal_name. " (".$lead->warehouse_code.")" !!}</td>
                                        <td>{!! $lead->price !!}</td>
                                        <td>{!! $lead->pincode !!}</td>
                                        <td>{!! $lead->location !!}</td>
                                        <td>{!! $lead->transport_cost !!}</td>
                                        <td><a href="{{ route('edit_corporate_user', ['id' => $lead->id]) }}" class="btn btn-info btn-xs" title="View">Update</a></td>
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

<script type="text/javascript">
    $(document).ready(function(){

        // Initialize select2
        $("#customer").select2({
            matcher: function(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') { return data; }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') { return null; }

                var q = params.term.toLowerCase();
                if (data.text.toLowerCase().indexOf(q) > -1 || data.id.toLowerCase().indexOf(q) > -1) {
                    return $.extend({}, data, true);
                }

                // Return `null` if the term should not be displayed
                return null;
            }
        });

    });

    $(document).ready( function () {
        var table = $('.dataTables-example1').DataTable( {
            pageLength : 3,
            lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection