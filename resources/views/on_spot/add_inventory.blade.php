@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add On Spot Inventory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('inventory') }}">Inventory</a>
            </li>
            <li class="active">
                <strong>Add On Spot Inventory</strong>
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
                <h5>Add On Spot Inventory</h5>
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
                        {!! Form::open(array('url' => 'add_inventory', 'files' => true)) !!}

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('warehouse', 'Terminal') !!}<span class="red">*</span>
                                    {!! Form::select('warehouse', $warehouses, '', ['class' => 'form-control', 'id' => 'warehouse']) !!}

                                    @if($errors->has('warehouse'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('warehouse') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('commodity', 'Commodity') !!}<span class="red">*</span>
                                    {!! Form::select('commodity', $categories, '', ['class' => 'form-control', 'id' => 'commodity']) !!}

                                    @if($errors->has('commodity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('net_weight', 'Net Weight (Qtl.)') !!}<span class="red">*</span>
                                    {!! Form::text('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Net Weight (Qtl.)']) !!}

                                    @if($errors->has('quantity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('price', 'Price') !!}<span class="red">*</span>
                                    {!! Form::text('price', '', ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price']) !!}

                                    @if($errors->has('price'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('file', 'Commodity Image') !!}
                                    {!! Form::file('file', ['class' => 'form-control', 'id' => 'file']) !!}

                                    @if($errors->has('file'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Add On Spot Inventory', ['class' => 'btn btn-info btn btn-block']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#user').on('change', function(){
            //Get All Cases
            var id = $(this).val();
            $.ajax({
                method : 'post',
                url: "{{ route('getCasesIdForUsers') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id' : id},
                success:function(response)
                {
                    $('#case_id').html(response);
                    $('#case_id').attr("multiple", true);
                    $('#script_show').html("");
                    $('#script_show').html("<script>$('.select-picker').multiselect({includeSelectAllOption: true,maxHeight: 200, filterBehavior: 'text',enableCaseInsensitiveFiltering: true, numberDisplayed: 0});<\/script>");
                    $('.select-picker').multiselect('rebuild');
                    console.log(response);
                },
                error: function(data)
                {
                    console.log(data);
                },
            });
        });
    $('.selectpicker').multiselect({
                            maxHeight: 250,
                            filterBehavior: 'text',
                            enableCaseInsensitiveFiltering: true,
                        });
    });
</script>

<div id="script_show"></div>
<link href="{{ asset('resources/assets/css/select.css') }}" rel="stylesheet">
<script src="{{ asset('resources/assets/js/select.js') }}"></script>
@endsection