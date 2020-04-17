@extends('layouts.auth_app')

@section('content')
{!! Form::open(array('url' => 'create_user_group', 'files' => true)) !!}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Users</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-6 text-right p-t-30">
        <button type="submit" name="create_group" class="btn btn-warning create_group">Create Group</button>
        <a href="{{ route('user_groups') }}" class="btn btn-primary">User Groups</a>
        <a href="{{ route('add_user_view') }}" class="btn btn-info">Add User</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Users</h5>
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
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->has('user_ids'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Please select user first.
                        </div>
                    @endif

                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover users_datatable">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Father</th>
                                    <th>Aadhar Number</th>
                                    <th>Pancard Number</th>
                                    <th>Bid Power</th>
                                    <th>Bank Name</th>
                                    <th>Bank Branch</th>
                                    <th>Bank Ac No</th>
                                    <th>Bank IFSC</th>
                                    <th>Address</th>
                                    <th>Village</th>
                                    <th>District</th>
                                    <th>Referral Code</th>
                                    <th>Transfer Amount</th>
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
{!! Form::close() !!}

<!-- Edit add_payment_ref_modal -->
<div id="referral_by_model" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">All Referred Contacts</h4>
            </div>
            <div class="modal-body">
                <div class="row">                        
                    <input type="hidden" name="id" id="ref_payment_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            <table id="table_data">
                                
                            </table>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">    
    $(document).ready(function(){
        var pTable = $('.users_datatable').dataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('usersByAjax') }}",
            "columns": [
                {data: 'sr_no', name: 'sr_no'},
                {data: 'action', name: 'action'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'father_name', name: 'father_name'},
                {data: 'aadhar_no', name: 'aadhar_no'},
                {data: 'pancard_no', name: 'pancard_no'},
                {data: 'power', name: 'power'},
                {data: 'bank_name', name: 'bank_name'},
                {data: 'bank_branch', name: 'bank_branch'},
                {data: 'bank_acc_no', name: 'bank_acc_no'},
                {data: 'bank_ifsc_code', name: 'bank_ifsc_code'},
                {data: 'address', name: 'address'},
                {data: 'village', name: 'village'},
                {data: 'district', name: 'district'},
                {data: 'referral_by', name: 'referral_by'},
                {data: 'transfer_amount', name: 'transfer_amount'},
            ],
        });

        pTable.on('click', '.referred_by', function(){
            var referral_id = $(this).attr('id');
            $.ajax({
                method : 'post',
                url: "{{ route('getReferredByUser') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'referral_id' : referral_id},
                success:function(response)
                {
                    console.log(response);
                    $('#table_data').html(response);
                    $('#referral_by_model').modal('show');
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
