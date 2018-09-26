@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Finance Response</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('finance') }}">Finances</a>
            </li>
            <li class="active">
                <strong>Finance Response</strong>
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
	                <h5>Finance Response against {!! $request->fname !!}'s commodity {!! $request->commodity !!} ( {!! $request->quantity !!} bags )</h5>
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

                    @if($request->finance_status == 2)
                        
                        <h1>
                            
                        User agree for this loan amount 
                        <strong>( Rs {{ $request->res_amount}} )</strong> 
                        and inetrest 
                        <strong>( {{ $request->res_interest}} %)</strong> 
                        from bank 
                        <strong>( {{ $request->res_bank_name}} ).</strong>

                        </h1>
                    @else

    	                <div class="row">                        
                            {!! Form::open(array('url' => 'request_responded', 'files' => true)) !!}
                                
                                {!! Form::hidden('finance_id', $finance_id) !!}

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('request_status', 'Request Status') !!}
                                        {!! Form::select('request_status', $response_status, $request->finance_status, ['class' => 'form-control', 'id' => 'request_status']) !!}                                        

                                        @if ($errors->has('request_status'))
                                            <span class="help-block red" role="alert">
                                                <strong>{{ $errors->first('request_status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('bank_name', 'Bank Name') !!}
                                        {!! Form::text('bank_name', $request->res_bank_name, ['class' => 'form-control', 'id' => 'bank_name', 'placeholder' => 'Bank Name']) !!}

                                        @if($errors->has('bank_name'))
                                            <span class="help-block red">
                                                <strong>{{ $errors->first('bank_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('amount', 'Amount') !!}
                                        {!! Form::number('amount', $request->res_amount, ['class' => 'form-control', 'id' => 'amount', 'placeholder' => 'Amount']) !!}

                                        @if($errors->has('amount'))
                                            <span class="help-block red">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('interest', 'Interest') !!}
                                        {!! Form::text('interest', $request->res_interest, ['class' => 'form-control', 'id' => 'interest', 'placeholder' => 'Interest']) !!}

                                        @if($errors->has('interest'))
                                            <span class="help-block red">
                                                <strong>{{ $errors->first('interest') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::submit('Submit Response', ['class' => 'btn btn-info btn btn-block']) !!}
                                    </div>
                                </div>

                            {!! Form::close() !!}

                        </div>                    

                    @endif 

	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
