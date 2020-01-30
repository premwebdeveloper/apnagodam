@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>My Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>My Profile</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">
            <div class="col-md-6">
                <img style="width: 100%;" src="{{ asset('resources/assets/upload/profile_image/'.$user->image) }}"  alt="profile">
            </div>
            <div class="col-md-6">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            {!! $user->fname !!}
                        </h2>
                        <h4>
                            @if($role->role_id == 2)
                                {!! ($user->user_type == 1)?'Seller':'Buyer' !!}
                            @endif
                        </h4>
                        <small>
                            Phone : <b>{!! $user->phone !!}</b>
                        </small><hr class="m-t-0 m-b-0">
                        <small>
                            Address : <b>{!! $user->address !!}, {!! $user->area_vilage !!}, {!! $user->state !!}, {!! $user->pincode !!} </b>
                        </small><hr class="m-t-0 m-b-0">
                        <small>
                            Referral Code : <b>{!! $user->referral_code !!}</b>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table small m-b-xs">
                @if($user->user_type == 1)
                    <tbody>
                        <tr>
                            <td>
                                Father's Name : <strong>{!! $user->father_name !!}</strong> 
                            </td>
                            <td>
                                Aadhar No. : <strong>{!! $user->aadhar_no !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Bank Name : <strong>{!! $user->bank_name !!}</strong> 
                            </td>
                            <td>
                                Account Number : <strong>{!! $user->bank_acc_no !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Branch Name : <strong>{!! $user->bank_branch !!}</strong> 
                            </td>
                            <td>
                                IFSC Code : <strong>{!! $user->bank_ifsc_code !!}</strong> 
                            </td>
                        </tr>
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td>
                                Firm Name : <strong>{!! $user->firm_name !!}</strong> 
                            </td>
                            <td>
                                Mandi License No. : <strong>{!! $user->mandi_license !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Prop./Partner/Manager Name : <strong>{!! $user->fname !!}</strong> 
                            </td>
                            <td>
                                GST Number : <strong>{!! $user->gst_number !!}</strong> 
                            </td>
                        </tr>                        
                    </tbody>
                @endif
            </table>
            @if($user->user_type == 1)
                <div class="col-md-12">
                    <a class="btn btn-info btn-xs" href="{{ asset('resources/frontend_assets/uploads/'.$user->cheque_image) }}" target="_blank">View Cheque Boo</a>
                    <a class="btn btn-info btn-xs" href="{{ asset('resources/frontend_assets/uploads/'.$user->aadhar_image) }}" target="_blank">View Aadhar Card</a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    @if(session('success'))
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    @endif
                    <h3>Update Profile Image</h3>
                    {!! Form::open(array('url' => 'updateProfileImage', 'files' => true)) !!}
                        @csrf
                        {{ Form::hidden('user_type', 2) }}
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <input id="profile_image" name="profile_image" type="file" class="form-control custom-file-input">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-primary btn-block">Update Profile Image</button>
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
        $("#my_commodity").dataTable( {
        dom: 'Bfrtip',
        buttons: ['csv', 'excel', 'pdf', 'print'],
        exportOptions:{
           columns: ':not(:last-child)'
        }
    } );
    });
</script>

@endsection