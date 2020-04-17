@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>All Lead Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Lead Reports</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Lead Reports</h5>                    
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('commodity_id', 'Commodity', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('commodity_id', $commodity, '', ['class' => 'form-control']); !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('terminal_id', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('terminal_id', $terminals, '', ['class' => 'form-control']); !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('employee', 'Employees', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::select('employee', $employees, '', ['class' => 'form-control']); !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('from_date', 'From Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::date('from_date', '', ['class' => 'form-control']); !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('to_date', 'To Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::date('to_date', '', ['class' => 'form-control']); !!}                            
                        </div>
                        <div class="col-md-4 m-t-40">
                            <a href="javascript:;" title="" class="generate_report w-100 btn btn-info">Generate Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-t-40" id="reports_data">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $('.generate_report').on('click', function(){
            var commodity_id = $('#commodity_id').val();
            var terminal_id = $('#terminal_id').val();
            var employee = $('#employee').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            $.ajax({
                method : 'post',
                url: "{{ route('get_lead_reports') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'commodity_id' : commodity_id, 'terminal_id' : terminal_id, 'employee' : employee, 'from_date' : from_date, 'to_date' : to_date},
                success:function(response)
                {
                    console.log(response);
                    $('#reports_data').html(response);
                },
                error: function(data)
                {
                    //console.log(data);
                    alert(data);
                },
            });
        });
    });
</script>
@endsection
