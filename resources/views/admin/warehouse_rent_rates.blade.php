@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Rent Rates</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Warehouse Rent Rates</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right">
        <h2>
            <a href="javascript:;" id="add_rent"class="btn btn-info">Add Rent</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Warehouse Rent Rates</h5>
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
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Area</th>
                                    <th>District</th>
                                    <th>Area in Sqr. Ft.</th>
                                    <th>Rent Per Month Per MT</th>
                                    <th>Capacity in MT</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $i = 1; ?>
                                @foreach($werehouse_rates as $key => $rent)
	                                <tr class="gradeX">
                                        <td>{!! $i !!}</td>
                                        <td>{!! $rent->address !!}</td>
                                        <td>{!! $rent->location !!}</td>
                                        <td>{!! $rent->area !!}</td>
                                        <td>{!! $rent->district !!}</td>
                                        <td>{!! $rent->area_sqr_ft !!}</td>
                                        <td>{!! $rent->rent_per_month !!}</td>
                                        <td>{!! $rent->capacity_in_mt !!}</td>
                                        <td>
                                            @if(Auth::user()->id == 1)
                                                <a href="{!! route('werehouse_rent_delete', ['id' => $rent->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
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

<!-- Modal -->
<div id="add_rent_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Werehouse Rent Rates</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'add_warehouse_rent', 'files' => true)) !!}
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('address', 'Address') !!}
                            {!! Form::text('address', '', ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}

                            @if($errors->has('address'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('location', 'Location') !!}
                            {!! Form::text('location', '', ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Location']) !!}

                            @if($errors->has('location'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('area', 'Area') !!}
                            {!! Form::text('area', '', ['class' => 'form-control', 'id' => 'area', 'placeholder' => 'Area']) !!}

                            @if($errors->has('area'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('district', 'District') !!}
                            {!! Form::text('district', '', ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) !!}

                            @if($errors->has('district'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('district') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('area_sqr_ft', 'Area in Sqr. Ft.') !!}
                            {!! Form::text('area_sqr_ft', '', ['class' => 'form-control', 'id' => 'area_sqr_ft', 'placeholder' => 'Area in Sqr. Ft.']) !!}

                            @if($errors->has('area_sqr_ft'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('area_sqr_ft') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('rent_per_month', 'Rent Per Month Per MT') !!}
                            {!! Form::text('rent_per_month', '', ['class' => 'form-control', 'id' => 'rent_per_month', 'placeholder' => 'Rent Per Month Per MT']) !!}

                            @if($errors->has('rent_per_month'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('rent_per_month') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('capacity_in_mt', 'Capacity in MT') !!}
                            {!! Form::text('capacity_in_mt', '', ['class' => 'form-control', 'id' => 'capacity_in_mt', 'placeholder' => 'Capacity in MT']) !!}

                            @if($errors->has('capacity_in_mt'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('capacity_in_mt') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Add Warehouse Rent Rates', ['class' => 'btn btn-info btn btn-block']) !!}
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
    });
</script>
@endsection
