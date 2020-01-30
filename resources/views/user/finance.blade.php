@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Finance / Loan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
        		<strong>Finance / Loan</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Finance / Loan</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="my_sell" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th>Terminal</th>
									<th>Commodity</th>
									<th>Bank Name</th>
									<th>Interest Rate</th>
									<th>Loan Pass Days</th>
									<th>Loan Amount</th>
									<th>Remaining Loan Amount</th>
									<th>Request Quantity</th>
									<th>Request Date</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($finances as $key => $finance)
									<tr>
										<th>{!! $key+1 !!}</th>
										<td>{!! $finance->name !!}</td>
										<td>{!! $finance->category !!}</td>
										<td>{!! $finance->bank_name !!}</td>
										<td>{!! $finance->interest_rate !!}</td>
										<td>{!! $finance->loan_pass_days !!}</td>
										<td>{!! $finance->amount !!}</td>
										<td>
											@if($finance->remaining_amount)
												{!! $finance->remaining_amount !!}
											@else
												{!! $finance->amount !!}
											@endif
										</td>
										<td>{!! $finance->quantity !!}</td>
										<td>{!! date('d M Y', strtotime($finance->created_at)) !!}</td>
										<td>

											@if(!empty($finance->status) && $finance->status == '1')

												<!-- Requested for loan -->
												<a href="javascript:;" class="btn-xs btn btn-warning" title="Requested"> Requested / Wait For Response</a>

											@elseif(!empty($finance->status) && $finance->status == '2')
												<!-- Request approve for loan -->
												<a href="javascript:;" class="btn-xs btn btn-primary" title="Approved"> Approved </a>

											@elseif(!empty($finance->status) && $finance->status == '0')

												<!-- Request Reject for loan -->
												<a href="{!! route('request_for_loan', ['id' => $finance->id]) !!}" class="btn-xs btn btn-danger" title="Rejected"> Rejected / Request Again</a>

											@else
												<a href="{!! route('request_for_loan', ['id' => $finance->id]) !!}" class="btn-xs btn btn-info" title="Request For Loan"> Request For Loan </a>

												<!-- Request for loan -->
											@endif

										</td>
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#my_sell").dataTable();
    });
</script>
@endsection