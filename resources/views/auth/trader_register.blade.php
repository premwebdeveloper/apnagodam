@extends('layouts.public_app')

@section('content')

<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="section-heading text-center">{{ __('Buyer Registration Form') }}</h2>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('trader_registration') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('error') }}
                                </div>
                            @endif
                            <input type="hidden" name="role_id" value="6">
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No.') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile No." required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Firm Name</label>

                                <div class="col-md-6">
                                    <input id="firm_name" type="text" class="form-control{{ $errors->has('firm_name') ? ' is-invalid' : '' }}" name="firm_name" placeholder="Firm Name" value="{{ old('firm_name') }}" required >

                                    @if ($errors->has('firm_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firm_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Prop./Partner/Manager Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" placeholder="Name" required >

                                    @if ($errors->has('fname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <textarea name="address" rows="4" cols="10" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address"></textarea>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Mandi License No.') }}</label>

                                <div class="col-md-6">
                                    <input id="license" type="text" class="form-control{{ $errors->has('license') ? ' is-invalid' : '' }}" name="license" value="{{ old('license') }}" placeholder="Mandi License No.">

                                    @if ($errors->has('license'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('GST No.') }}</label>

                                <div class="col-md-6">
                                    <input id="gst" type="text" class="form-control{{ $errors->has('gst') ? ' is-invalid' : '' }}" name="gst" value="{{ old('gst') }}" placeholder="GST No.">

                                    @if ($errors->has('gst'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gst') }}</strong>
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
