@extends('layouts.auth_app')

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        var commodity = "{!! $today_price->commodity_id !!}";
        var terminal_id = "{!! $today_price->terminal_id !!}";
        $("#terminal_id option[value="+terminal_id+"]").attr("selected","selected");
        $("#commodity option[value="+commodity+"]").attr("selected","selected");
    });
</script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Today's Price</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('today_price') }}">Today's Price</a>
            </li>
            <li class="active">
                <strong>Edit Today's Price</strong>
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
                <h5>Edit Today's Price</h5>
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
                        {!! Form::open(array('url' => 'today_price_edit', 'files' => true)) !!}
                            @csrf
                            {{ Form::hidden('id', $today_price->id) }}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('terminal', 'Terminal') !!}
                                    <select name="warehouse" id="terminal_id" class="form-control" required="">
                                        <option value="">Select Terminal</option>
                                        @foreach($warehouses as $key => $warehouse)
                                            <option value="{!! $warehouse->id !!}">{!! $warehouse->name !!} ( {!! $warehouse->warehouse_code !!} )</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('warehouse'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('warehouse') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('commodity', 'Commodity Name') !!}
                                    <select name="commodity" id="commodity" class="form-control" required="">
                                        <option value="">Select Commodity Name</option>
                                        @foreach($commodities as $key => $commodity)
                                            <option value="{!! $commodity->id !!}">{!! $commodity->category !!}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('commodity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('modal', 'Modal') !!}
                                    {!! Form::text('modal', $today_price->modal, ['class' => 'form-control', 'id' => 'modal', 'placeholder' => 'Modal']) !!}

                                    @if($errors->has('modal'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('modal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('max', 'Max') !!}
                                    {!! Form::text('max', $today_price->max, ['class' => 'form-control', 'id' => 'max', 'placeholder' => 'Max']) !!}

                                    @if($errors->has('max'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('max') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('min', 'Min') !!}
                                    {!! Form::text('min', $today_price->min, ['class' => 'form-control', 'id' => 'min', 'placeholder' => 'Min']) !!}

                                    @if($errors->has('min'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('min') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Update Today Price', ['class' => 'btn btn-info btn btn-block']) !!}
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