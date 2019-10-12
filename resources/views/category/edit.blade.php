@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Category / Commodity</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('category') }}">Category</a>
            </li>
            <li class="active">
                <strong>Edit Category / Commodity</strong>
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
                <h5>Edit Category / Commodity</h5>
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
                        {!! Form::open(array('url' => 'edit_category', 'files' => true)) !!}
                            {{ Form::hidden('id', $category->id) }}
                            {{ Form::hidden('img', $category->image) }}
 
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('gst', 'GST') !!}
                                    {!! Form::number('gst', $category->gst, ['class' => 'form-control', 'id' => 'gst', 'placeholder' => 'GST', 'step' => '0.01']) !!}

                                    @if($errors->has('gst'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gst') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('commossion', 'Commossion') !!}
                                    {!! Form::number('commossion', $category->commossion, ['class' => 'form-control', 'id' => 'commossion', 'placeholder' => 'Commosion', 'step' => '0.01']) !!}

                                    @if($errors->has('commossion'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commossion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('mandi_fees', 'Mandi Fees (%)') !!}
                                    {!! Form::number('mandi_fees', $category->mandi_fees, ['class' => 'form-control', 'id' => 'mandi_fees', 'placeholder' => 'Mandi Fees', 'step' => '0.01']) !!}

                                    @if($errors->has('mandi_fees'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi_fees') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('loading', 'Loading') !!}
                                    {!! Form::number('loading', $category->loading, ['class' => 'form-control', 'id' => 'loading', 'placeholder' => 'Loading', 'step' => '0.01']) !!}

                                    @if($errors->has('loading'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('loading') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('bardana', 'Bardana') !!}
                                    {!! Form::number('bardana', $category->bardana, ['class' => 'form-control', 'id' => 'bardana', 'placeholder' => 'Bardana', 'step' => '0.01']) !!}

                                    @if($errors->has('bardana'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('bardana') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('freight', 'Freight') !!}
                                    {!! Form::number('freight', $category->freight, ['class' => 'form-control', 'id' => 'freight', 'placeholder' => 'Freight', 'step' => '0.01']) !!}

                                    @if($errors->has('freight'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('freight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('commodity_type', 'Commodity / Category Type') !!}
                                    {!! Form::select('commodity_type', ['Paid' => 'Paid', 'Payable' => 'Payable'], '',['class' => 'form-control', 'id' => 'commodity_type']) !!}

                                    @if($errors->has('commodity_type'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                    {!! Form::submit('Update Category / Commodity', ['class' => 'btn btn-info btn btn-block']) !!}
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