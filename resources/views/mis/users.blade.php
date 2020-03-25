@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
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
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Users</h5>                    
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>View</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Father</th>
                                    <th>Aadhar Number</th>
                                    <th>Pan Card Number</th>
                                    <th>Bank Name</th>
                                    <th>Bank Branch</th>
                                    <th>Bank Ac No</th>
                                    <th>Bank IFSC</th>
                                    <th>Address</th>
                                    <th>Village/Area</th>
                                    <th>District</th>
                                    <th>Aadhar Image</th>
                                    <th>Cheque Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($users as $key => $user)
                                    <tr class="gradeX">
                                        <td>{!! ++$key !!}</td>
                                        <td>
                                            <a href="{!! route('user_view_by_account', ['user_id' => $user->user_id]) !!}" class="btn btn-info btn-xs" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>                                            
                                        </td>
                                        <td>{!! $user->fname . $user->lname !!}</td>
                                        <td>{!! $user->phone !!}</td>
                                        <td>{!! $user->father_name !!}</td>
                                        <td>{!! $user->aadhar_no !!}</td>
                                        <td>{!! $user->pancard_no !!}</td>
                                        <td>{!! $user->bank_name !!}</td>
                                        <td>{!! $user->bank_branch !!}</td>
                                        <td>{!! $user->bank_acc_no !!}</td>
                                        <td>{!! $user->bank_ifsc_code !!}</td>
                                        <td>{!! $user->address !!}</td>
                                        <td>{!! $user->village !!}</td>
                                        <td>{!! $user->district !!}</td>
                                        <td>@if($user->aadhar_image)
                                                <a download href="{{ asset('resources/frontend_assets/uploads/'.$user->aadhar_image) }}" class="btn btn-xs btn-info"><i class="fa fa-download"></i></a>
                                            @else
                                                Not Uploaded
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->cheque_image)
                                                <a download href="{{ asset('resources/frontend_assets/uploads/'.$user->cheque_image) }}" class="btn btn-xs btn-info"><i class="fa fa-download"></i></a>
                                            @else
                                                Not Uploaded
                                            @endif
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    ?>
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
