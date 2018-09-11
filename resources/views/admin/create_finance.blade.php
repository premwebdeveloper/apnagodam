@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create Finance</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Finance</a>
            </li>
            <li class="active">
                <strong>Create Finance</strong>
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
                <h5>Create Finance</h5>
            </div>
                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                {!! Form::open(array('url' => 'create_finance', 'files' => true)) !!}
                    
                    <div class="form-group">
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>


                    </div>
                {!! Form::close() !!}
                                    
                </div>
            </div>

        </div>
    </div>
</div>

@endsection