@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
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
<!--     <div class="col-lg-2 text-right">
        <h2>
            <a href="" class="btn btn-info">Add User</a>
        </h2>
    </div> -->
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

                    <?php //echo '<pre>'; print_r($users);?>

	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>S.No.</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>

	                            @foreach($users as $key => $user)

	                                <tr class="gradeX">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            
                                            @if($user->status == 2)
	                                        <a class="btn btn-info" title="Delete" href="#{{$user->user_id}}" data-toggle="modal">
	                                            Active
	                                        </a>
	                                        @else
	                                        <a class="btn btn-danger" title="Delete" href="#{{$user->user_id}}" data-toggle="modal">
	                                            Inactive
	                                        </a>
	                                        @endif
	                                    </td>
	                                </tr>

                                    <!-- active / inactive user modal -->
									<div id="{{$user->user_id}}" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title"><i class="fa fa-trash"></i> User Approval</h4>
											  </div>
											  <div class="modal-body">
												<form method="post" action="{{route('active_inactive')}}">
													{{ csrf_field() }}
													<input type="hidden" name="user_id" value="{{$user->user_id}}">
													<input type="hidden" name="status" value="{{$user->status}}">
													<p>
													  	@if($user->status==2)
															Are you sure you want to Active this client ?
														@else
															Are you sure you want to Inactive this client ?
														@endif

														<button class="btn btn-danger pull-right" type="submit" name="approve" value="{{$user->user_id}}">Yes</button>

													</p>
												</form>
											  </div>
											</div>
										</div>
									</div>

	                            @endforeach

	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>
@endsection
