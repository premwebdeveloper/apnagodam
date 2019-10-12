@extends('layouts.auth_app')

@section('content')
	<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Monthly</span>
                        <h5>Views</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">386,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total views</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Annual</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,800</h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5>visits</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins">406,42</h1>
                                <div class="font-bold text-navy">44% <i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                            </div>
                            <div class="col-md-6">
                                <h1 class="no-margins">206,12</h1>
                                <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Monthly income</h5>
                        <div class="ibox-tools">
                            <span class="label label-primary">Updated 12.2015</span>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="flot-chart m-t-lg" style="height: 55px;">
                            <div class="flot-chart-content" id="flot-chart1"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div>
                            <span class="pull-right text-right">
                            <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                <br/>
                                All sales: 162,862
                            </span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>

                        <div class="m-t-sm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div>
                                    	<img alt="image" src="resources/assets/images/step.jpg" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 48%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>From Date</label>
                        <input type="date" id="from_date" value="" name="from_date" placeholder="From Date" class="form-control">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label>To Date</label>
                        <input type="date" id="to_date" value="" name="to_date" placeholder="To Date" class="form-control">
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <a href="javascript:;" id="1" class="sales_reocrd btn btn-success btn-md" style="width: 100%">Monthly Report Primary Sales</a>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <a href="javascript:;" id="2" class="sales_reocrd btn btn-primary btn-md" style="width: 100%">Monthly Report Secondary Sales</a>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <a href="{{ asset('resources/frontend_assets/reports/niryat_partivedan.pdf') }}" target="_blank" class="btn btn-warning btn-md">Niryat Partivedan</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">Data has changed</span>
                        <h5>User activity</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>236 321.80</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>46.11%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>432.021</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>643 321.10</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>92.43%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>564.554</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>436 547.20</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>150.23%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>124.990</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
	        <div class="col-lg-12">
		        <div class="ibox float-e-margins">
		        	<div class="ibox-content">
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
            var from_date = $('#from_date').val();
            var to_date   = $('#to_date').val();

            $.ajax({
                method : 'post',
                url: "{{ route('getSalesCSV') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'status' : status, 'from_date' : from_date, 'to_date' : to_date},
                success:function(response)
                {
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