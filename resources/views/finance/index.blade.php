@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Finance / Loan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Finance</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-6 p-t-30 text-right">
        <a href="javascript:;" class="btn btn-sm btn-warning edit_max_loan">Max Loan Amount : {!! $loan_max_value->loan_value !!}%</a>
        <a href="javascript:;" class="btn btn-sm btn-primary upload_remain_amount">Upload Remaining Amount</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('status') !!}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Seller</th>
                                    <th scope="col">Terminal</th>
                                    <th scope="col">Gate Pass</th>
                                    <th scope="col">Bank Name</th>
                                    <th scope="col">Loan Amount</th>
                                    <th scope="col">Remaining Amount</th>
                                    <th scope="col">Request Quantity</th>
                                    <th scope="col">Request Date</th>
                                    <th scope="col">Approve Date</th>
                                    <th scope="col">Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($requests as $key => $request)
                                <tr>
                                    <td>{!! $request->fname !!}</td>
                                    <td>{!! $request->name !!}</td>
                                    <td>{!! $request->gate_pass_wr !!}</td>
                                    <td>{!! $request->bank_name !!}</td>
                                    <td class="text-info">{!! $request->amount !!} 
                                        @if($request->status != 2)
                                        &nbsp;&nbsp;
                                        <a class="btn btn-xs btn-info edit_loan_amount" id="{!! $request->id !!}_{!! $request->amount !!}" href="javascript:;"><i class="fa fa-pencil"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-danger">{!! $request->remaining_amount !!}</td>
                                    <td>{!! $request->quantity !!}</td>
                                    <td>
                                        @if($request->status == 2)
                                            {!! date('d M Y', strtotime($request->created_at)) !!}
                                        @endif
                                    </td>
                                    <td>{!! date('d M Y', strtotime($request->updated_at)) !!}</td>
                                    <td>
                                        @if($request->status == 2)
                                            <a href="javascript:;" class="btn btn-xs btn-primary">Approved</a>
                                        @else
                                            <a href="javascript:;" id="{!! $request->id !!}" class="request_response btn btn-xs btn-warning">Response</a>
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

<!-- Modal -->
<div id="request_response_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Finance / Loan Request Response</h4>
      </div>
      <div class="modal-body">
        <div class="row">

                {!! Form::open(array('url' => 'request_responded', 'files' => true)) !!}
                    <input type="hidden" name="status" value="2">
                    <input type="hidden" class="finance_id" name="finance_id">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::submit('Accept', ['class' => 'btn btn-primary btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
                {!! Form::open(array('url' => 'request_responded', 'files' => true)) !!}
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" class="finance_id" name="finance_id">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::submit('Reject', ['class' => 'btn btn-danger btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>


<!-- Edit Loan Amount Modal -->
<div id="edit_loan_amount_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Loan Amount</h4>
      </div>
      <div class="modal-body">
        <div class="row">

                {!! Form::open(array('url' => 'edit_loan_amount', 'files' => true)) !!}
                    <input type="hidden" name="status" value="2">
                    <input type="hidden" id="f_id" name="f_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('loan_amount','Enter Loan Amount') !!}
                            {!! Form::number('loan_amount', '', ['class' => 'form-control', 'id' => 'loan_amount']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Update Amount', ['class' => 'btn btn-primary btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<!-- Import Contact Modal -->
<div class="modal fade" id="upload_remain_amount_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title mt-0">Upload Remaining Amount via CSV</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-6"> 
                        {!! Form::open(array('url' => 'updateRemainingAmount', 'files' => true)) !!}                   
                            <div class="form-group">
                                {!! Form::file('file', ['class' => 'form-control', 'id' => 'file', 'requried' => 'requried']) !!}
                            </div>
                            {!! Form::submit('Import CSV', ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                        {!! Form::close() !!}
                        <div class="download-sample text-center">
                            <a download class="btn btn-link" href="uploads/sample/sampleremainingamount.csv">Download Sample CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Loan Max Value Modal -->
<div class="modal fade" id="upload_max_amount_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title mt-0">Max Loan Amount </h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-6"> 
                        {!! Form::open(array('url' => 'updateMaxLoanAmount', 'files' => true)) !!}                   
                            <div class="form-group">
                                {!! Form::number('max_loan_amount', $loan_max_value->loan_value, ['class' => 'form-control', 'id' => 'max_loan_amount', 'max' => 100,'requried' => 'requried']) !!}
                            </div>
                            {!! Form::submit('Update Max Loan Amount', ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    $(document).ready(function(){
        $('.request_response').on('click', function(){
            var id = $(this).attr('id');
            $('.finance_id').val(id);
            $('#request_response_modal').modal('show');
        });

        //Update Remaining Amount
        $('.upload_remain_amount').on('click', function(){
            $('#upload_remain_amount_modal').modal('show');
        });

        //Update Remaining Amount
        $('.edit_max_loan').on('click', function(){
            $('#upload_max_amount_modal').modal('show');
        });

        $('.edit_loan_amount').on('click', function(){
            var temp = $(this).attr('id');
            var data = temp.split('_');
            $('#f_id').val(data[0]);
            $('#loan_amount').val(data[1]);
            $('#edit_loan_amount_modal').modal('show');
        });
    });
</script>

@endsection
