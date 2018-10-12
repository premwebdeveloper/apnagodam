@extends('layouts.public_app')

@section('content')
<style>
    .py-4{
        padding-top: 0rem!important;
    }
    .masthead{
        height: 20vh!important;
        min-height: 140px!important;
    }
</style>

<header class="masthead text-white d-flex masthalf"></header>

<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <h2 class="section-heading">Request For Loan against {!! $inventory->category !!} commodity with {!! $inventory->quantity !!} Bags.</h2>
                <br>

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
                    
                {!! Form::open(array('url' => 'loan_request', 'files' => true)) !!}
                    
                    {!! Form::hidden('commodity_id', $commodity_id) !!}
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('pan_card', 'Pan Card') !!}
                            {!! Form::file('pan_card', ['class' => 'form-control', 'id' => 'pan_card']) !!}

                            @if($errors->has('pan_card'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('pan_card') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('aadhar_card', 'Aadhar Card') !!}
                            {!! Form::file('aadhar_card', ['class' => 'form-control', 'id' => 'aadhar_card']) !!}

                            @if($errors->has('aadhar_card'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('aadhar_card') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('balance_sheet', 'Balance Sheet (Two Year)') !!}
                            {!! Form::file('balance_sheet', ['class' => 'form-control', 'id' => 'balance_sheet']) !!}

                            @if($errors->has('balance_sheet'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('balance_sheet') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('bank_statement', 'Bank Statement (Six Months)') !!}
                            {!! Form::file('bank_statement', ['class' => 'form-control', 'id' => 'bank_statement']) !!}

                            @if($errors->has('bank_statement'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('bank_statement') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('bank_name', 'Bank Name') !!}
                            {!! Form::text('bank_name', '', ['class' => 'form-control', 'id' => 'bank_name', 'placeholder' => 'Bank Name']) !!}

                            @if($errors->has('bank_name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('account_number', 'Account Number') !!}
                            {!! Form::text('account_number', '', ['class' => 'form-control', 'id' => 'account_number', 'placeholder' => 'Account Number']) !!}

                            @if($errors->has('account_number'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('account_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('ifsc_code', 'IFSC Code') !!}
                            {!! Form::text('ifsc_code', '', ['class' => 'form-control', 'id' => 'ifsc_code', 'placeholder' => 'IFSC Code']) !!}

                            @if($errors->has('ifsc_code'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('ifsc_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('branch_name', 'Banch Name') !!}
                            {!! Form::text('branch_name', '', ['class' => 'form-control', 'id' => 'branch_name', 'placeholder' => 'Banch Name']) !!}

                            @if($errors->has('branch_name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('branch_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('quantity', 'Quantity') !!}
                            {!! Form::number('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Quantity']) !!}

                            @if($errors->has('quantity'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('amount', 'Amount') !!}
                            {!! Form::number('amount', '', ['class' => 'form-control', 'id' => 'amount', 'placeholder' => 'Amount']) !!}

                            @if($errors->has('amount'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            {!! Form::submit('Request For Loan', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}


            </div>

        </div>
    </div>
</section>

@endsection