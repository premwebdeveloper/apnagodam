@extends('layouts.public_app')

@section('content')
<style>
	.py-4{
			padding-top: 0rem!important;
	}
	.masthead{
			height: 20vh!important;
			min-height: 140px!important;
	}
</style>

<header class="masthead text-white d-flex masthalf"></header>

<section id="about">
	<div class="container">
		<div class="row">

			<div class="col-lg-12 text-center">
				<h2 class="section-heading">Finance / Loan</h2>
				<hr>

				@if(session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Terminal</th>
						<th scope="col">Commodity</th>
						<th scope="col">Bank Name</th>
						<th scope="col">Interest Rate</th>
						<th scope="col">Loan Pass Days</th>
						<th scope="col">Loan Amount</th>
						<th scope="col">Request Quantity</th>
						<th scope="col">Request Date</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($finances as $key => $finance)
						<tr>
							<th scope="row">{!! $key+1 !!}</th>
							<td>{!! $finance->name !!}</td>
							<td>{!! $finance->category !!}</td>
							<td>{!! $finance->bank_name !!}</td>
							<td>{!! $finance->interest_rate !!}</td>
							<td>{!! $finance->loan_pass_days !!}</td>
							<td>{!! $finance->amount !!}</td>
							<td>{!! $finance->quantity !!}</td>
							<td>{!! date('d M Y', strtotime($finance->created_at)) !!}</td>
							<td>

								@if(!empty($finance->status) && $finance->status == '1')

									<!-- Requested for loan -->
									<a href="javascript:;" class="btn btn-warning" title="Requested"> Requested / Wait For Response</a>

								@elseif(!empty($finance->status) && $finance->status == '2')
									<!-- Request approve for loan -->
									<a href="javascript:;" class="btn btn-success" title="Approved"> Approved </a>

								@elseif(!empty($finance->status) && $finance->status == '0')

									<!-- Request Reject for loan -->
									<a href="{!! route('request_for_loan', ['id' => $finance->id]) !!}" class="btn btn-danger" title="Rejected"> Rejected / Request Again</a>

								@else
									<a href="{!! route('request_for_loan', ['id' => $finance->id]) !!}" class="btn btn-primary" title="Request For Loan"> Request For Loan </a>

									<!-- Request for loan -->
								@endif

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>

@endsection