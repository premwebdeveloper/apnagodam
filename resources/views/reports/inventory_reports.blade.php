@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>All Inventory Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Inventory Reports</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Inventory Reports</h5>                    
                </div>

                <div class="ibox-content">
                    {!! Form::open(array('url' => 'addAccounts', 'files' => true, 'class' => "contact_us_form", 'id' => 'reportForm')) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::label('report_type', 'Report Type', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('report_type', ['1' => 'Case Wise', '2' => 'Case IN Wise', '3' => 'Case OUT Wise', '4' => 'All Stock', '5' => 'In Stock', '6' => 'Out Stock', '7' => 'Non-Zero Stock'], '', ['class' => 'form-control']); !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('terminal_id', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('terminal_id[]', $terminals, '', ['class' => 'form-control select-picker', 'multiple' => 'true']); !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('users', 'Users', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                <span class="red">*</span>
                                {!! Form::select('users[]', $users, '', ['class' => 'form-control select-picker', 'multiple' => 'true']); !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('commodity_id', 'Commodity', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('commodity_id[]', $commodity, '', ['class' => 'form-control select-picker', 'multiple' => 'true']); !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('from_date', 'From Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::date('from_date', '', ['class' => 'form-control']); !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('to_date', 'To Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::date('to_date', '', ['class' => 'form-control']); !!}                            
                            </div>
                            <div class="col-md-12 m-t-40">
                                <a href="javascript:;" title="" class="generate_report w-100 btn btn-info">Generate Inventory Report</a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="col-md-12 p-t-40" id="reports_data">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<script type="text/javascript">
    $(document).ready(function(){

        $('.generate_report').on('click', function(){
            var res = $("form#reportForm").serializeArray();
            var users = [];
            var commodity_id = [];
            var terminal_id = [];
            var i = 0;
            var j = 0;
            var k = 0;

            $.each(res, function(i, field){
                if(field.name == 'terminal_id[]'){
                    terminal_id[i] = field.value;
                    i++;
                }
                if(field.name == 'commodity_id[]'){
                    commodity_id[j] = field.value;
                    j++;
                }
                if(field.name == 'users[]'){
                    users[k] = field.value;
                    k++;
                }
            });
            var report_type = $('#report_type').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            $.ajax({
                method : 'post',
                url: "{{ route('get_inventory_reports') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'report_type' : report_type, 'commodity_id' : commodity_id, 'terminal_id' : terminal_id, 'users' : users, 'from_date' : from_date, 'to_date' : to_date},
                success:function(response)
                {
                    alert('Report Generated Successfully!');
                    $('#reports_data').html(response);
                },
                error: function(data)
                {
                    //console.log(data);
                    //alert(data);
                },
            });
        });
        $('.select-picker').multiselect({
                            includeSelectAllOption: true, 
                            maxHeight: 200, 
                            numberDisplayed: 0,
                            selectAllValue: 0,
                            enableCaseInsensitiveFiltering: true,
                            includeSelectAllOption: true,
                        });
    });
</script>
<link href="{{ asset('resources/assets/css/select.css') }}" rel="stylesheet">
<script src="{{ asset('resources/assets/js/select.js') }}"></script>
@endsection
