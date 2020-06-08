 @extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Inventory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Inventory</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-4 text-right" style="padding-top: 30px;">
        <!-- <a href="javascript:;" class="btn btn-info btn-sm import_csv">Import Inventories</a> -->
        <a href="{{ route('create_inventory') }}" class="btn btn-info btn-sm">Add Inventory</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Inventory</h5>
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
                            {!! session('status') !!}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table id="inventory_table" class="table table-striped table-bordered table-hover">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <!-- <th>Action</th> -->
                                    <th>Case IDs</th>
                                    <!-- <th>In / Out</th> -->
                                    <th>Seller</th>
                                    <th>Terminal</th>
                                    <!-- <th>Gatepass No.</th> -->
                                    <th>Commodity</th>
                                    <th>Bags</th>
                                    <th>Net Weight (Qtl.)</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
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


<!-- Import Contact Modal -->
<div class="modal fade bs-example-modal-center" id="import_contact" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title mt-0">Import Inventory</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-6"> 
                        {!! Form::open(array('url' => 'upload_inventory', 'files' => true)) !!}                   
                            <div class="form-group">
                                {!! Form::file('file', ['class' => 'form-control', 'id' => 'file', 'requried' => 'requried']) !!}
                            </div>
                            {!! Form::submit('Import CSV', ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                        {!! Form::close() !!}
                        <div class="download-sample text-center">
                            <a download class="btn btn-link" href="uploads/sample/sampleinventries.csv">Download Sample CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    $(document).ready(function(){
        var pTable = $('#inventory_table').dataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('getAllInventoresByAjax') }}",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columns": [
                {data: 'id', name: 'id'},
                /*{data: 'action', name: 'action'},*/
                {data: 'case_ids', name: 'case_ids'},
                /*{data: 'in_out', name: 'in_out'},*/
                {data: 'user_name', name: 'user_name'},
                {data: 'warehouse_name', name: 'warehouse_name'},
                /*{data: 'gate_pass_wr', name: 'gate_pass_wr'},*/
                {data: 'category', name: 'category'},
                {data: 'no_of_bags', name: 'no_of_bags'},
                {data: 'quantity', name: 'quantity'},
                {data: 'date', name: 'date'},
                {data: 'in__out_status', name: 'in__out_status'},
            ],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]
        });

        //Inventory Import Modal
        $('.import_csv').on('click', function(){
            $('#import_contact').modal('show');
        });
    });
</script>
@endsection
