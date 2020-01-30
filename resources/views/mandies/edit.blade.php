@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Update Mandi Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('mandi_place_name') }}">Mandi Details</a>
            </li>
            <li class="active">
                <strong>Update Mandi Details</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update Mandi Name</h5>
            </div>                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">                        
                        {!! Form::open(array('url' => 'mandi_edit', 'files' => true)) !!}
                            @csrf
                            {{ Form::hidden('id', $mandi->id) }}

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('mandi', 'Mandi Name') !!}<span class="red">*</span>
                                    {!! Form::text('mandi', $mandi->mandi_name, ['class' => 'form-control', 'id' => 'mandi', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Mandi Name']) !!}

                                    @if($errors->has('mandi'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('mandi_tax_fees', 'Mandi Tax Fees (%)') !!}<span class="red">*</span>
                                    {!! Form::number('mandi_tax_fees', $mandi->mandi_tax_fees, ['class' => 'form-control', 'id' => 'mandi_tax_fees', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Mandi Tax Fees (%)', 'step'=>'any']) !!}

                                    @if($errors->has('mandi_tax_fees'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi_tax_fees') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email Address') !!}<span class="red">*</span>
                                    {!! Form::text('email', $mandi->email, ['class' => 'form-control', 'id' => 'email', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Email Address']) !!}

                                    @if($errors->has('email'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('phone', 'Phone') !!}<span class="red">*</span>
                                    {!! Form::number('phone', $mandi->phone, ['class' => 'form-control', 'id' => 'phone', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Phone']) !!}

                                    @if($errors->has('phone'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('bank_name', 'Bank Name') !!}<span class="red">*</span>
                                    {!! Form::text('bank_name', $mandi->bank_name, ['class' => 'form-control', 'id' => 'bank_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Bank Name']) !!}

                                    @if($errors->has('bank_name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('account_holder', 'Account Holder Name') !!}<span class="red">*</span>
                                    {!! Form::text('account_holder', $mandi->account_holder, ['class' => 'form-control', 'id' => 'account_holder', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Account Holder Name']) !!}

                                    @if($errors->has('account_holder'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('account_holder') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('bank_account_no', 'Account Number') !!}<span class="red">*</span>
                                    {!! Form::number('bank_account_no', $mandi->bank_account_no, ['class' => 'form-control', 'id' => 'bank_account_no', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Account Number']) !!}

                                    @if($errors->has('bank_account_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('bank_account_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('branch_name', 'Branch Name') !!}<span class="red">*</span>
                                    {!! Form::text('branch_name', $mandi->branch_name, ['class' => 'form-control', 'id' => 'branch_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Branch Name']) !!}

                                    @if($errors->has('branch_name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('branch_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('branch_ifsc', 'Bank IFSC Code') !!}<span class="red">*</span>
                                    {!! Form::text('branch_ifsc', $mandi->branch_ifsc, ['class' => 'form-control', 'id' => 'branch_ifsc', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Bank IFSC Code']) !!}

                                    @if($errors->has('branch_ifsc'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('branch_ifsc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Update & Save Mandi Details', ['class' => 'btn btn-info btn btn-block']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection