@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Bank Master</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Bank Master</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right">
        <h2>
            <a href="javascript:;" id="add_rent"class="btn btn-info">Add Bank Master</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Bank Master</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>Sr.No.</th>
                                    <th>Bank Name</th>
                                    <th>Interest Rate (%)</th>
                                    <th>Processing Fees (%)</th>
                                    <th>Loan Pass Days</th>
                                    <th>Loan Per Total Amount(%)</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $i = 1; ?>
                                @foreach($bank_masters as $key => $bank_master)
	                                <tr class="gradeX">
                                        <td>{!! $i !!}</td>
                                        <td>{!! $bank_master->bank_name !!}</td>
                                        <td>{!! $bank_master->interest_rate !!}</td>
                                        <td>{!! $bank_master->processing_fee !!}</td>
                                        <td>{!! $bank_master->loan_pass_days !!}</td>
                                        <td>{!! $bank_master->loan_per_total_amount !!}</td>
                                        <td>
                                            @if(Auth::user()->id == 1)
                                                <a href="javascript:;" class="edit_bank btn btn-info btn-xs" id="{!! $bank_master->id !!}_{!! $bank_master->bank_name !!}_{!! $bank_master->interest_rate !!}_{!! $bank_master->processing_fee !!}_{!! $bank_master->loan_pass_days !!}_{!! $bank_master->loan_per_total_amount !!}" title="Edit">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                @if($bank_master->id != 1)
                                                    <a href="{!! route('bank_master_delete', ['id' => $bank_master->id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
	                                </tr>
                                    <?php $i++; ?>
                                @endforeach
	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>

<!-- Add Bank Modal -->
<div id="add_rent_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Bank Master</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'add_bank_master', 'files' => true)) !!}
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('bank_name', 'Bank Name') !!}
                            {!! Form::text('bank_name', '', ['class' => 'form-control', 'id' => 'bank_name', 'placeholder' => 'Bank Name', 'required' => 'required']) !!}

                            @if($errors->has('bank_name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('interest_rate', 'Interest Rate (%)') !!}
                            {!! Form::number('interest_rate', '', ['class' => 'form-control', 'id' => 'interest_rate', 'placeholder' => 'Interest Rate', 'step' => '0.01', 'required' => 'required']) !!}

                            @if($errors->has('interest_rate'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('interest_rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('processing_fee', 'Processing Fees (%)') !!}
                            {!! Form::number('processing_fee', '', ['class' => 'form-control', 'id' => 'processing_fee', 'placeholder' => 'Processing Fee', 'step' => '0.01', 'required' => 'required']) !!}

                            @if($errors->has('processing_fee'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('processing_fee') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('loan_pass_days', 'Loan Pass Days') !!}
                            {!! Form::number('loan_pass_days', '', ['class' => 'form-control', 'id' => 'loan_pass_days', 'placeholder' => 'Loan Pass Days', 'required' => 'required']) !!}

                            @if($errors->has('loan_pass_days'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('loan_pass_days') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('loan_per_total_amount', 'Loan Per Total Amount(%)') !!}
                            {!! Form::number('loan_per_total_amount', '', ['class' => 'form-control', 'placeholder' => 'Loan Per Total Amount', 'required' => 'required']) !!}

                            @if($errors->has('loan_per_total_amount'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('loan_per_total_amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Add Bank Master', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<!-- Edit Bank Modal -->
<div id="edit_rent_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Bank Master</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'edit_bank_master', 'files' => true)) !!}
                    <input type="hidden" name="bank_master_id" id="edit_bank_master_id">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('bank_name', 'Bank Name') !!}
                            {!! Form::text('bank_name', '', ['class' => 'form-control', 'id' => 'edit_bank_name', 'placeholder' => 'Bank Name']) !!}

                            @if($errors->has('bank_name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('interest_rate', 'Interest Rate (%)') !!}
                            {!! Form::number('interest_rate', '', ['class' => 'form-control', 'id' => 'edit_interest_rate', 'placeholder' => 'Interest Rate', 'step' => '0.01']) !!}

                            @if($errors->has('interest_rate'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('interest_rate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('processing_fee', 'Processing Fees (%)') !!}
                            {!! Form::number('processing_fee', '', ['class' => 'form-control', 'id' => 'edit_processing_fee', 'placeholder' => 'Processing Fee', 'step' => '0.01']) !!}

                            @if($errors->has('processing_fee'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('processing_fee') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('loan_pass_days', 'Loan Pass Days') !!}
                            {!! Form::number('loan_pass_days', '', ['class' => 'form-control', 'id' => 'edit_loan_pass_days', 'placeholder' => 'Loan Pass Days']) !!}

                            @if($errors->has('loan_pass_days'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('loan_pass_days') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('loan_per_total_amount', 'Loan Per Total Amount(%)') !!}
                            {!! Form::number('loan_per_total_amount', '', ['class' => 'form-control', 'id' => 'loan_per_t_amount', 'placeholder' => 'Loan Per Total Amount', 'required' => 'required']) !!}

                            @if($errors->has('loan_per_total_amount'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('loan_per_total_amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Update Bank Master', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add_rent').on('click', function(){
            $('#add_rent_modal').modal('show');
        });
        $('.edit_bank').on('click', function(){
            var temp = $(this).attr('id');
            var data = temp.split('_');

            $('#edit_bank_master_id').val(data[0]);
            $('#edit_bank_name').val(data[1]);
            $('#edit_interest_rate').val(data[2]);
            $('#edit_processing_fee').val(data[3]);
            $('#edit_loan_pass_days').val(data[4]);
            $('#loan_per_t_amount').val(data[5]);
            $('#edit_rent_modal').modal('show');
        });
    });
</script>
@endsection
