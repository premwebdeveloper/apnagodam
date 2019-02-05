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
				<h2 class="section-heading">Finance</h2>
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
						<th scope="col">Quantity (Bags)</th>
						<th scope="col">Price (Rs/Bag) </th>
						<th scope="col">Date Of Deposit</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($inventories as $key => $inventory)
						<tr>
							<th scope="row">{!! $key+1 !!}</th>
							<td>{!! $inventory->name !!}</td>
							<td>{!! $inventory->category !!}</td>
							<td>{!! $inventory->quantity !!}</td>
							<td>{!! $inventory->price !!}</td>

							<td>{!! $inventory->created_at !!}</td>

							<td>

								@if(!empty($inventory->finance_status) && $inventory->finance_status == '1')

									<!-- Requested for loan -->
									<a href="{!! route('requested_for_loan', ['finance_id' => $inventory->finance_id, 'id' => $inventory->id]) !!}" class="btn btn-warning" title="Requested"> Requested / Wait For Response</a>

								@elseif(!empty($inventory->finance_status) && $inventory->finance_status == '2')

									<!-- Request approve for loan -->
									<a href="{!! route('loan_approved', ['id' => $inventory->finance_id]) !!}" class="btn btn-info" title="Approved"> Approved </a>

								@elseif(!empty($inventory->finance_status) && $inventory->finance_status == '-1')

									<!-- Request Reject for loan -->
									<a href="{!! route('request_for_loan', ['id' => $inventory->id]) !!}" class="btn btn-danger" title="Rejected"> Rejected / Request Again</a>

								@elseif(!empty($inventory->finance_status) && $inventory->finance_status == '3')

									<!-- Request Reject for loan -->
									<a href="javascript:;" class="btn btn-success" title="Rejected"> Done</a>

								@else

									<!-- Request for loan -->
									<a href="{!! route('request_for_loan', ['id' => $inventory->id]) !!}" class="btn btn-primary" title="Request For Loan"> Request For Loan </a>
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