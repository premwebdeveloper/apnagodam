@extends('layouts.public_app')

@section('content')

<header class="masthead text-white d-flex masthalf"></header>
<style type="text/css">
    .red{
        color: red;
    }
</style>
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="section-heading text-center">{{ __('Seller Registration Form') }}</h2>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('farmer_registration') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('error') }}
                                </div>
                            @endif
                            <input type="hidden" name="role_id" value="5">
                            <div class="form-group row">

                                <label for="phone" class="col-md-4 col-form-label text-md-right"><span class="red">*</span> {{ __('Mobile No.') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile No." required="required" autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red">*</span> {{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="Name" required>

                                    @if ($errors->has('fname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> Father's Name</label>

                                <div class="col-md-6">
                                    <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" placeholder="Father's Name" value="{{ old('father_name') }}">

                                    @if ($errors->has('father_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('father_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="aadhar" class="col-md-4 col-form-label text-md-right">
                                    <span class="red">*</span>{{ __('Aadhar No.') }}</label>

                                <div class="col-md-6">
                                    <input id="aadhar" type="number" class="form-control{{ $errors->has('aadhar') ? ' is-invalid' : '' }}" name="aadhar" value="{{ old('aadhar') }}" placeholder="Aadhar No." required="required">

                                    @if ($errors->has('aadhar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('aadhar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address">

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Village') }}</label>

                                <div class="col-md-6">
                                    <input id="village" type="text" class="form-control{{ $errors->has('village') ? ' is-invalid' : '' }}" name="village" value="{{ old('village') }}" placeholder="Village">

                                    @if ($errors->has('village'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                                <div class="col-md-6">
                                    <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" placeholder="District">

                                    @if ($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> {{ __('Bank Name') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_name" type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name">

                                    @if ($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> {{ __('Bank Branch') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_branch" type="text" class="form-control{{ $errors->has('bank_branch') ? ' is-invalid' : '' }}" name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Bank Branch">

                                    @if ($errors->has('bank_branch'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_branch') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> {{ __('Bank Account No.') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_acc_no" type="text" class="form-control{{ $errors->has('bank_acc_no') ? ' is-invalid' : '' }}" name="bank_acc_no" value="{{ old('bank_acc_no') }}" placeholder="Bank Account No.">

                                    @if ($errors->has('bank_acc_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_acc_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> {{ __('Bank IFSC Code') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_ifsc_code" type="text" class="form-control{{ $errors->has('bank_ifsc_code') ? ' is-invalid' : '' }}" name="bank_ifsc_code" value="{{ old('bank_ifsc_code') }}" placeholder="Bank IFSC Code">

                                    @if ($errors->has('bank_ifsc_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_ifsc_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red"></span> {{ __('Referred By') }}</label>

                                <div class="col-md-6">
                                    <input id="ref_referral_code" type="text" class="form-control" name="ref_referral_code" value="{{ old('ref_referral_code') }}" placeholder="Reference Referral Code" maxlength="6" minlength="6">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red">*</span> {{ __('Aadhar Card') }}</label>

                                <div class="col-md-6">
                                    {!! Form::file('aadhar_image', ['class' => 'form-control', 'required' => 'required', 'id' => 'aadhar_image']) !!}

                                    @if ($errors->has('aadhar_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('aadhar_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="red">*</span> {{ __('Cheque') }}</label>

                                <div class="col-md-6">
                                    {!! Form::file('cheque_image', ['class' => 'form-control', 'required' => 'required', 'id' => 'cheque_image']) !!}

                                    @if ($errors->has('cheque_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cheque_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
