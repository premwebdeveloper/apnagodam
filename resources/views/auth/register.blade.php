@extends('layouts.public_app')

@section('content')
<main id="main"> <!-- main body conatiner starts-->
    <header class="masthead text-white d-flex" style="margin-bottom: 40px;">
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <h1 class="text-uppercase">
                        <strong>Technology enabled<br/>Warehousing & Logistics</strong>
                    </h1>
                </div>
            </div>
        </div>
    </header>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="section-heading text-center">{{ __('Enquiry') }}</h2>
            <hr>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" required autofocus>

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
                                <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ old('father_name') }}" required autofocus>

                                @if ($errors->has('father_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Khasra No.') }}</label>

                            <div class="col-md-6">
                                <input id="khasra" type="text" class="form-control{{ $errors->has('khasra') ? ' is-invalid' : '' }}" name="khasra" value="{{ old('khasra') }}" required autofocus>

                                @if ($errors->has('khasra'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('khasra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Village') }}</label>

                            <div class="col-md-6">
                                <input id="village" type="text" class="form-control{{ $errors->has('village') ? ' is-invalid' : '' }}" name="village" value="{{ old('village') }}" required autofocus>

                                @if ($errors->has('village'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('village') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tehsil') }}</label>

                            <div class="col-md-6">
                                <input id="tehsil" type="text" class="form-control{{ $errors->has('tehsil') ? ' is-invalid' : '' }}" name="tehsil" value="{{ old('tehsil') }}" required autofocus>

                                @if ($errors->has('tehsil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tehsil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" required autofocus>

                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Commodity Name/Weight/No. of Bag') }}</label>

                            <div class="col-md-6">
                                <input id="commodity" type="text" class="form-control{{ $errors->has('commodity') ? ' is-invalid' : '' }}" name="commodity" value="{{ old('commodity') }}" required autofocus>

                                @if ($errors->has('commodity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('commodity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
