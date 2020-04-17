@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Pass Cases Status </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Pass Cases Status</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Pass Cases Status List</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">

                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example1">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Case_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>Customer Name</th>
                                    <th>Commodity</th>
                                    <th>Terminal</th>
                                    <th>Quality Report</th>
                                    <th>Pricing</th>
                                    <th>Truck Book</th>
                                    <th>Labour Book</th>
                                    <th>First Kanta Parchi</th>
                                    <th>Second Quality Report</th>
                                    <th>Second Kanta Parchi</th>
                                    <th>Gate Pass</th>
                                    <th>E-Mandi</th>
                                    <th>Accounts</th>
                                    <th>IVR Tagging</th>
                                    <th>Shipment Start</th>
                                    <th>Shipment End</th>
                                    <th>Quality Claim</th>
                                    <th>Truck Payment</th>
                                    <th>Labour Payment</th>
                                    <th>Payment Received</th>
                                    <th>Created On</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $lead)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $lead->case_id !!}</td>
                                        <td>{!! $lead->cust_fname." ".$lead->cust_lname !!}</td>
                                        <td>{!! $lead->cate_name ." (".$lead->commodity_type.")"  !!}</td>
                                        <td>{!! $lead->terminal_name. " (".$lead->warehouse_code.")" !!}</td>

                                        <td>{!! ($lead->quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->quality_report_update_time)?date('g:i A', strtotime($lead->quality_report_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->quality_report_file)?"<a class='view_file' data-id='quality_report/".$lead->quality_report_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->pricing_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->pricing_update_time)?date('g:i A', strtotime($lead->pricing_update_time)):'' }}
                                    </td>
                                        <td>{!! ($lead->truck_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->truck_book_update_time)?date('g:i A', strtotime($lead->truck_book_update_time)):'' }}
                                    </td>
                                        <td>{!! ($lead->labour_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->labour_book_update_time)?date('g:i A', strtotime($lead->labour_book_update_time)):'' }}
                                    </td>
                                        <td>{!! ($lead->kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->kanta_parchi_update_time)?date('g:i A', strtotime($lead->kanta_parchi_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->kanta_parchi_file)?"<a class='view_file' data-id='kanta_parchi/".$lead->kanta_parchi_file."'><i class='fa fa-eye'></i></a>":'' !!}&nbsp;&nbsp;&nbsp;
                                            {!! ($lead->kanta_parchi_file_2)?"<a class='view_file' data-id='kanta_parchi/".$lead->kanta_parchi_file_2."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->second_quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->second_quality_report_update_time)?date('g:i A', strtotime($lead->second_quality_report_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->second_quality_report_file)?"<a class='view_file' data-id='second_quality_report/".$lead->second_quality_report_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->second_kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->second_kanta_parchi_update_time)?date('g:i A', strtotime($lead->second_kanta_parchi_update_time)):'' }}
                                            {!! ($lead->second_kanta_parchi_file)?"<a class='view_file' data-id='second_kanta_parchi/".$lead->second_kanta_parchi_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                        &nbsp;&nbsp;&nbsp;
                                            {!! ($lead->second_kanta_parchi_file_2)?"<a class='view_file' data-id='second_kanta_parchi/".$lead->second_kanta_parchi_file_2."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->gate_pass_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->gate_pass_update_time)?date('g:i A', strtotime($lead->gate_pass_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->gate_pass_file)?"<a class='view_file' data-id='gate_pass/".$lead->gate_pass_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        
                                        <td>{!! ($lead->transaction_type == 'E-Mandi')?(($lead->e_mandi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>'):'<span class="text-info">Not for E-Mandi</span>' !!}<br>{{ ($lead->transaction_type == 'E-Mandi')?(($lead->e_mandi_update_time)?date('g:i A', strtotime($lead->e_mandi_update_time)):''):'' }}
                                            <br/>
                                            {!! ($lead->e_mandi_file)?"<a class='view_file' data-id='e_mandi/".$lead->e_mandi_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                        
                                        </td>
                                        
                                        <td>{!! ($lead->accounts_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->accounts_update_time)?date('g:i A', strtotime($lead->accounts_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->accounts_file)?"<a class='view_file' data-id='accounts/".$lead->accounts_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->ivr_tagging_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->ivr_tagging_update_time)?date('g:i A', strtotime($lead->ivr_tagging_update_time)):'' }}
                                            <br/>
                                            {!! ($lead->ivr_tagging_file)?"<a class='view_file' data-id='truck_payment/".$lead->ivr_tagging_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->shipping_start_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->shipping_start_update_time)?date('g:i A', strtotime($lead->shipping_start_update_time)):'' }}
                                    </td>
                                        <td>{!! ($lead->shipping_end_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->shipping_end_update_time)?date('g:i A', strtotime($lead->shipping_end_update_time)):'' }}
                                    </td>
                                        <td>{!! ($lead->quality_claim_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->quality_claim_update_time)?date('g:i A', strtotime($lead->quality_claim_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->quality_claim_file)?"<a class='view_file' data-id='quality_claim/".$lead->quality_claim_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->truck_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->truck_payment_update_time)?date('g:i A', strtotime($lead->truck_payment_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->truck_payment_file)?"<a class='view_file' data-id='truck_payment/".$lead->truck_payment_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->labour_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->labour_payment_update_time)?date('g:i A', strtotime($lead->labour_payment_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->labour_payment_file)?"<a class='view_file' data-id='labour_payment/".$lead->labour_payment_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! ($lead->payment_received_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}
                                        <br>{{ ($lead->payment_received_update_time)?date('g:i A', strtotime($lead->payment_received_update_time)):'' }}
                                        <br/>
                                            {!! ($lead->payment_received_file)?"<a class='view_file' data-id='payment_received/".$lead->payment_received_file."'><i class='fa fa-eye'></i></a>":'' !!}
                                    </td>
                                        <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
	                                </tr>
                                @endforeach
	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>
<div id="viewQualityReport" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View File</h4>
            </div>
            <div class="modal-body">                
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-info btn-xd" download id="download_file">Download</a>
                    </div>
                    <div class="col-md-12">
                        <object type=""  style="width:100%;min-height:450px;" data="" id="object_data">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.view_file').on('click', function(){
            var file = $(this).attr('data-id');
            var full_url = "<?= url('/'); ?>/resources/assets/upload/"+file;
            $('#object_data').attr('data', '');
            $('#object_data').attr('data', full_url);
            $('#download_file').attr('href', '');
            $('#download_file').attr('href', full_url);
            $('#viewQualityReport').modal('show');
        });
    });
    $(document).ready( function () {
        var table = $('.dataTables-example1').DataTable( {
        pageLength : 3,
        lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
      });
    });
</script>
@endsection
