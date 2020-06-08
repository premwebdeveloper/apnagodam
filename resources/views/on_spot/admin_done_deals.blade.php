@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Done Deals</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Done Deals</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Done Deals</h5>
                     @if($role->role_id == 1)
                        <div class="ibox-tools">
                            <span class="red">Deal Approve Time : 01:00 PM to 06:30PM</span>
                        </div>
                    @endif
                </div>

                <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover deals_datatable">
                            <thead>
                                <tr>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Gate Pass</th>
                                    <th>Payment Ref. No.</th>
                                    <th>KUMS</th>
                                    <th>Terminal</th>
                                    <th>Commodity</th>
                                    <th>Net Weight (Qtl.)</th>
                                    <th>Today's Price</th>
                                    <th>Bid Price</th>
                                    <th>Done Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Bank Modal -->
<div id="gate_pass_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Gate Pass</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'payment_accept', 'files' => true)) !!}
                    <input type="hidden" name="id" id="payment_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('gate_pass', 'Gate Pass No.') !!}
                            {!! Form::text('gate_pass', '', ['class' => 'form-control', 'id' => 'payment_gate_pass', 'placeholder' => 'Gate Pass']) !!}

                            @if($errors->has('gate_pass'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('gate_pass') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Change GatePass / Approve Deal', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<!-- Edit add_payment_ref_modal -->
<div id="add_payment_ref_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Payment Reference Number</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'add_payment_ref', 'files' => true)) !!}
                    <input type="hidden" name="id" id="ref_payment_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('payment_ref_no', 'Payment Reference Number') !!}
                            {!! Form::text('payment_ref_no', '', ['class' => 'form-control', 'id' => 'payment_gate_pass', 'placeholder' => 'Payment Reference Number']) !!}

                            @if($errors->has('payment_ref_no'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('payment_ref_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Add Payment Ref Number', ['class' => 'btn btn-info btn btn-block']) !!}
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
        var pTable = $('.deals_datatable').dataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('getAllDealsDoneByAjax') }}",
            "columns": [
                {data: 'buyer_name', name: 'buyer_name'},
                {data: 'seller_name', name: 'seller_name'},
                {data: 'gate_pass_wr', name: 'gate_pass_wr'},
                {data: 'payment_ref_no', name: 'payment_ref_no'},
                {data: 'mandi_samiti_name', name: 'mandi_samiti_name'},
                {data: 'warehouse', name: 'warehouse'},
                {data: 'category', name: 'category'},
                {data: 'quantity', name: 'quantity'},
                {data: 'todays_price', name: 'todays_price'},
                {data: 'price', name: 'price'},
                {data: 'done_date', name: 'done_date'},
                {data: 'action', name: 'action'},
            ],
        });

        pTable.on('click', '.edit_gate_pass', function(){
            var temp = $(this).attr('id');
            var data = temp.split('_');
            $('#payment_id').val(data[0]);
            $('#payment_gate_pass').val(data[1]);
            $('#gate_pass_edit').modal('show');
        });
        pTable.on('click', '.add_payment_ref', function(){
            var id = $(this).attr('id');
            $('#ref_payment_id').val(id);
            $('#add_payment_ref_modal').modal('show');
        });
    });
</script>


@endsection
