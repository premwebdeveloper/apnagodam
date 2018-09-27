@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('category') }}">Category</a>
            </li>
            <li class="active">
                <strong>Edit Category</strong>
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
                <h5>Edit Category</h5>
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
                        {!! Form::open(array('url' => 'category_edit', 'files' => true)) !!}
                            
                            {{ Form::hidden('id', $category->id) }}
 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('category', 'Category Name') !!}
                                    {!! Form::text('category', $category->category, ['class' => 'form-control', 'id' => 'category', 'placeholder' => 'Category Name']) !!}

                                    @if($errors->has('category'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('gst', 'GST') !!}
                                    {!! Form::text('gst', $category->gst, ['class' => 'form-control', 'id' => 'gst', 'placeholder' => 'GST']) !!}

                                    @if($errors->has('gst'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gst') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('commossion', 'Commossion') !!}
                                    {!! Form::text('commossion', $category->commossion, ['class' => 'form-control', 'id' => 'commossion', 'placeholder' => 'Commosion']) !!}

                                    @if($errors->has('commossion'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commossion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mandi_fees', 'Mandi Fees') !!}
                                    {!! Form::text('mandi_fees', $category->mandi_fees, ['class' => 'form-control', 'id' => 'mandi_fees', 'placeholder' => 'Mandi Fees']) !!}

                                    @if($errors->has('mandi_fees'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi_fees') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('loading', 'Loading') !!}
                                    {!! Form::text('loading', $category->loading, ['class' => 'form-control', 'id' => 'loading', 'placeholder' => 'Loading']) !!}

                                    @if($errors->has('loading'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('loading') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('bardana', 'Bardana') !!}
                                    {!! Form::text('bardana', $category->bardana, ['class' => 'form-control', 'id' => 'bardana', 'placeholder' => 'Bardana']) !!}

                                    @if($errors->has('bardana'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('bardana') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('freight', 'Freight') !!}
                                    {!! Form::text('freight', $category->freight, ['class' => 'form-control', 'id' => 'freight', 'placeholder' => 'Freight']) !!}

                                    @if($errors->has('freight'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('freight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('image', 'Upload Image') !!}
                                    {!! Form::file('image') !!}

                                    @if($errors->has('image'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Edit Category', ['class' => 'btn btn-info btn btn-block']) !!}
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