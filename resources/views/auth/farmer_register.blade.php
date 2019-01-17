@extends('layouts.public_app')

@section('content')

<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="section-heading text-center">{{ __('Registration Form') }}</h2>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('farmer_registration') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            <input type="hidden" name="role_id" value="5">
                            <div class="form-group row">

                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile No." required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="Name" required autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Father's Name</label>

                                <div class="col-md-6">
                                    <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" placeholder="Father's Name" value="{{ old('father_name') }}" required autofocus>

                                    @if ($errors->has('father_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('father_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="aadhar" class="col-md-4 col-form-label text-md-right">{{ __('Aadhar No.') }}</label>

                                <div class="col-md-6">
                                    <input id="aadhar" type="number" class="form-control{{ $errors->has('aadhar') ? ' is-invalid' : '' }}" name="aadhar" value="{{ old('aadhar') }}" placeholder="Aadhar No.">

                                    @if ($errors->has('aadhar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('aadhar') }}</strong>
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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_name" type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name" required autofocus>

                                    @if ($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Branch') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_branch" type="text" class="form-control{{ $errors->has('bank_branch') ? ' is-invalid' : '' }}" name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Bank Branch" required autofocus>

                                    @if ($errors->has('bank_branch'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_branch') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account No.') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_acc_no" type="text" class="form-control{{ $errors->has('bank_acc_no') ? ' is-invalid' : '' }}" name="bank_acc_no" value="{{ old('bank_acc_no') }}" placeholder="Bank Account No." required autofocus>

                                    @if ($errors->has('bank_acc_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_acc_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Bank IFSC Code') }}</label>

                                <div class="col-md-6">
                                    <input id="bank_ifsc_code" type="text" class="form-control{{ $errors->has('bank_ifsc_code') ? ' is-invalid' : '' }}" name="bank_ifsc_code" value="{{ old('bank_ifsc_code') }}" placeholder="Bank IFSC Code" required autofocus>

                                    @if ($errors->has('bank_ifsc_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_ifsc_code') }}</strong>
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
