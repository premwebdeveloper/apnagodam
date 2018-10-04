@extends('layouts.public_app')

@section('content')

<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="section-heading text-center">{{ __('Enquiry Form') }}</h2>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

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
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail Address">

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
                                    <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone No." required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select id="category" name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" required="">
                                        <option value="">Select Category</option>
                                        <option value="1">Farmer</option>
                                        <option value="2">Trader</option>
                                        <option value="3">Miller</option>
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" id="khasra_show">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Khasra No.') }}</label>

                                <div class="col-md-6">
                                    <input id="khasra" type="text" class="form-control{{ $errors->has('khasra') ? ' is-invalid' : '' }}" name="khasra" value="{{ old('khasra') }}" placeholder="Khasra No.">

                                    @if ($errors->has('khasra'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('khasra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" id="gst_show">
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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Village') }}</label>

                                <div class="col-md-6">
                                    <input id="village" type="text" class="form-control{{ $errors->has('village') ? ' is-invalid' : '' }}" name="village" value="{{ old('village') }}" placeholder="Village" required autofocus>

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
                                    <input id="tehsil" type="text" class="form-control{{ $errors->has('tehsil') ? ' is-invalid' : '' }}" name="tehsil" value="{{ old('tehsil') }}" placeholder="Tehsil" required autofocus>

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
                                    <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" placeholder="District" required autofocus>

                                    @if ($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enquiry') }}
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
