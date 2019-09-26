@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>Add User</strong>
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
                <h5>Add User</h5>
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
                        {!! Form::open(array('url' => 'add_user', 'files' => true)) !!}
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('fname', 'Name') !!}
                                    {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'Name']) !!}

                                    @if($errors->has('fname'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email ID') !!}
                                    {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'example@gmail.com']) !!}

                                    @if($errors->has('email'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('password', 'Password') !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => '******']) !!}
                            
                                    @if($errors->has('password'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => '******']) !!}
                            
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> -->
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('phone', 'Phone') !!}
                                    {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => '9876543210']) !!}

                                    @if($errors->has('phone'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('father_name', 'Father Name') !!}
                                    {!! Form::text('father_name', '', ['class' => 'form-control', 'id' => 'father_name', 'placeholder' => 'Father Name']) !!}

                                    @if($errors->has('father_name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('father_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <script>
                                $(document).ready(function(){

                                    $(document).on('change', '#category', function(){
                                        var category = $('#category').val();
                                        if(category==1){
                                            $("#khasra_show").show();
                                            $("#gst_show").hide();
                                        }
                                        else if(category==2 || category==3){
                                            $("#khasra_show").hide();
                                            $("#gst_show").show();
                                        }
                                        else{
                                            $("#khasra_show").hide();
                                            $("#gst_show").hide();
                                        }
                                    });  
                                    $("#khasra_show").hide();
                                    $("#gst_show").hide();
                                });
                            </script>
                            <div class="col-md-3">
                                <label for="name">{{ __('Category') }}</label>

                                <div class="form-group">
                                    <select id="category" name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}">
                                        <option value="">Select Category</option>
                                        <option value="1">Seller</option>
                                        <option value="2">Buyer</option>
                                        <option value="3">Miller</option>
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="help-block red" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3" id="khasra_show">
                                <div class="form-group">
                                    {!! Form::label('khasra', 'Khasra Number') !!}
                                    {!! Form::text('khasra', '', ['class' => 'form-control', 'id' => 'khasra', 'placeholder' => 'Khasra Number']) !!}

                                    @if($errors->has('khasra'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('khasra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>   
                            <div class="col-md-3" id="gst_show">
                                <div class="form-group">
                                    {!! Form::label('gst', 'GST Number') !!}
                                    {!! Form::text('gst', '', ['class' => 'form-control', 'id' => 'gst', 'placeholder' => 'GST Number']) !!}

                                    @if($errors->has('gst'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gst') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('village', 'Village') !!}
                                    {!! Form::text('village', '', ['class' => 'form-control', 'id' => 'village', 'placeholder' => 'Village']) !!}

                                    @if($errors->has('village'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('tehsil', 'Tehsil') !!}
                                    {!! Form::text('tehsil', '', ['class' => 'form-control', 'id' => 'tehsil', 'placeholder' => 'Tehsil']) !!}

                                    @if($errors->has('tehsil'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('tehsil') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('district', 'District') !!}
                                    {!! Form::text('district', '', ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) !!}

                                    @if($errors->has('district'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('image', 'Image') !!}
                                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}
                                </div>
                            </div>   

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Add User', ['class' => 'btn btn-info btn btn-block']) !!}
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