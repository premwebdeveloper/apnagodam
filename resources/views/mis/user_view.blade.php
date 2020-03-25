@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>User Details</strong>
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
                    </div>
                </div>
                <table class="table small m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                Phone :<strong>{!! $user->phone !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address : <strong>{!! $user->address !!}, {!! $user->area_vilage !!}, {!! $user->state !!}, {!! $user->pincode !!} </strong> 
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                Bank Name : <strong>{!! $user->bank_name !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Account Number : <strong>{!! $user->bank_acc_no !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Branch Name : <strong>{!! $user->bank_branch !!}</strong> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                IFSC Code : <strong>{!! $user->bank_ifsc_code !!}</strong> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table small m-b-xs">
                <tbody>
                    <tr>
                        <td>
                            Pan Card No. :<strong>{!! $user->pancard_no !!}</strong> 
                        </td>
                        <td>
                            Aadhar No. : <strong>{!! $user->aadhar_no !!}</strong> 
                        </td>
                    </tr>
                    <tr>
                    @if($user->user_type == 1)
                        <td>
                            Father's Name : <strong>{!! $user->father_name !!}</strong> 
                        </td>
                        <td>
                            Referral Code :<strong>{!! $user->referral_code !!}</strong> 
                        </td>
                    </tr>
                    @endif
                    @if($user->user_type == 2)
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
                    @endif
                </tbody>
            </table>
            <div class="col-md-6">
                <label>Aadhar Card</label><br>
                @if($user->aadhar_image)
                    <object type="" style="width:100%;max-height:400px;" data="{{ asset('resources/frontend_assets/uploads/'.$user->aadhar_image) }}"></object>
                    <a href="{{ asset('resources/frontend_assets/uploads/'.$user->aadhar_image) }}" class="btn btn-info btn-xs"><i class="fa fa-download"></i> </a>
                @else
                    Not Uploaded
                @endif
            </div>
            <div class="col-md-6">
                <label>Cheque Book</label><br>
                @if($user->cheque_image)
                    <object type="" style="width:100%;max-height:400px;" data="{{ asset('resources/frontend_assets/uploads/'.$user->cheque_image) }}"></object>
                    <a href="{{ asset('resources/frontend_assets/uploads/'.$user->cheque_image) }}" class="btn btn-info btn-xs"><i class="fa fa-download"></i> </a>
                @else
                    Not Uploaded
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
