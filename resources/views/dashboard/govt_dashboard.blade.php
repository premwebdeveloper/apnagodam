@extends('layouts.auth_app')

@section('content')
	<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>E-Mandi Primary Report</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <label>From Date</label>
                            <input type="date" id="from_date" value="" name="from_date" placeholder="From Date" class="form-control">
                        </div>
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <label>To Date</label>
                            <input type="date" id="to_date" value="" name="to_date" placeholder="To Date" class="form-control">
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a href="javascript:;" id="1" class="sales_reocrd btn btn-success btn-md" style="width: 100%">Generate Primary Sales Report</a>
                        </div>
                    </div>
                </div>
                <h2>E-Mandi Secondary Report</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <label>From Date</label>
                            <input type="date" id="from_date_secondary" value="" name="from_date" placeholder="From Date" class="form-control">
                        </div>
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <label>To Date</label>
                            <input type="date" id="to_date_secondary" value="" name="to_date" placeholder="To Date" class="form-control">
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a href="javascript:;" id="2" class="sales_reocrd btn btn-primary btn-md" style="width: 100%">Generate Secondary Sales Report</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img style="width: 100%;" src="{{ asset('resources/frontend_assets/img/logo-img.png') }}">
            </div>
        </div>

        <div class="row">
	        <div class="col-lg-12">
		        <div class="ibox float-e-margins">
		        	<div class="ibox-content">
                        <h2 class="report-heading"></h2>
			            <div class="table-responsive sales_result">
			            </div>
		        	</div>
		        </div>
	        </div>
        </div>
    </div>

	<div class="row">
	<div class="col-lg-12">
    <script type="text/javascript">
        $(document).ready(function(){
            $('.sales_reocrd').on('click', function(){
                var status    = $(this).attr('id');
                if(status == 1)
                {
                    var from_date = $('#from_date').val();
                    var to_date   = $('#to_date').val();
                }else{
                    var from_date = $('#from_date_secondary').val();
                    var to_date   = $('#to_date_secondary').val();
                }

                $.ajax({
                    method : 'post',
                    url: "{{ route('getSalesCSV') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'status' : status, 'from_date' : from_date, 'to_date' : to_date},
                    success:function(response)
                    {
                        if(status == 1)
                        {
                            $('.report-heading').html('Primary Sale Report');
                        }else{
                            $('.report-heading').html('Secondary Sale Report');
                        }
                        console.log(response);
                        $('.sales_result').html(response);
                    },
                    error: function(data)
                    {
                        console.log(data);
                    },
                });
            });
        });
    </script>
@endsection