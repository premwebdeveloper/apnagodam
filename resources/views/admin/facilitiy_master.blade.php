@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Facility Master</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Facility Master</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-2 text-right">
        <h2>
            <a href="javascript:;" id="add_rent"class="btn btn-info">Add Facility Master</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Facility Master</h5>
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $i = 1; ?>
                                @foreach($facilitiy_masters as $key => $facilitiy_master)
	                                <tr class="gradeX">
                                        <td>{!! $i !!}</td>
                                        <td>{!! $facilitiy_master->name !!}</td>
                                        <td>{!! $facilitiy_master->description !!}</td>
                                        <td><img style="height: 50px;" src="{{ asset('resources/assets/upload/facilitiy_master/') }}/{!! $facilitiy_master->image !!}"> </td>
                                        <td>
                                            @if(Auth::user()->id == 1)
                                                <a href="{!! route('facility_master_delete', ['id' => $facilitiy_master->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete">
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
        <h4 class="modal-title">Add Facility Master</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'add_facility_master', 'files' => true)) !!}
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}

                            @if($errors->has('name'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('image', 'Image') !!}
                            {{ Form::file('image', ['class' => 'form-control']) }}

                            @if($errors->has('area'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', '', ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description']) !!}

                            @if($errors->has('description'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Add Facility Master', ['class' => 'btn btn-info btn btn-block']) !!}
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
