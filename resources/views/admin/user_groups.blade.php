@extends('layouts.auth_app')

@section('content')
{!! Form::open(array('url' => 'create_user_group', 'files' => true)) !!}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>All User Gropus</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>User Gropus</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>User Gropus</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Group ID</th>
                                    <th>Group User Names</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($users as $key => $user)
	                                <tr class="gradeX">
                                        <td>{!! $key+1 !!}</td>
                                        <td>{!! $user->group_id !!}</td>
                                        <td>
                                            @php
                                            $user_ids = json_decode($user->user_ids);
                                            foreach($user_ids as $id)
                                            {
                                                $user_details = DB::table('user_details')->where('user_id', $id)->first();
                                                echo "(".$user_details->phone.") ";
                                            }
                                            @endphp
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
{!! Form::close() !!}
@endsection
