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
                        <td>
                            Power :<strong>{!! $user->power !!}</strong> 
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
                @else
                    Not Uploaded
                @endif
            </div>
            <div class="col-md-6">
                <label>Cheque Book</label><br>
                @if($user->cheque_image)
                    <object type="" style="width:100%;max-height:400px;" data="{{ asset('resources/frontend_assets/uploads/'.$user->cheque_image) }}"></object>
                @else
                    Not Uploaded
                @endif
            </div>
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
                    @if(session('status'))
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    @endif
                    <h3>Update Profile</h3>
                    {!! Form::open(array('url' => 'updateUserProfile', 'files' => true)) !!}
                        @csrf
                        {{ Form::hidden('user_id', $user->user_id) }}
                        {{ Form::hidden('user_type', $user->user_type) }}
                        {{ Form::hidden('aadhar_img', $user->aadhar_image) }}
                        {{ Form::hidden('cheque_img', $user->cheque_image) }}
                        {{ Form::hidden('profile_img', $user->image) }}
                            <div class="row">
                                <div class="col-lg-4">
                                        {!! Form::label('Profile Image', 'Profile Image', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                        <input id="profile_image" name="profile_image" type="file" class="form-control custom-file-input">
                                </div>
                                @if($user->user_type == 2)
                                    <div class="col-md-4">
                                        {!! Form::label('license', 'Mandi License No.', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                        {!! Form::text('license', $user->mandi_license, ['class' => 'form-control', 'id' => 'license', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Mandi License No.']) !!}
                                        @if($errors->has('license'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gst') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        {!! Form::label('gst', 'GST No.', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                        {!! Form::text('gst', $user->mandi_license, ['class' => 'form-control', 'id' => 'gst', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Firm GST No.']) !!}
                                        @if($errors->has('gst'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gst') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                @if($user->user_type == 1)
                                    <div class="col-md-4">
                                        {!! Form::label('father_name', 'Father\'s Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                        {!! Form::text('father_name', $user->father_name, ['class' => 'form-control', 'id' => 'father_name', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Father\'s Name']) !!}
                                    
                                        @if($errors->has('father_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('father_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    {!! Form::label('address', 'Address', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                    {!! Form::text('address', $user->address, ['class' => 'form-control', 'id' => 'address', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Street Address']) !!}
                                    @if($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('area_vilage', 'Village / Area', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                    {!! Form::text('area_vilage', $user->area_vilage, ['class' => 'form-control', 'id' => 'area_vilage', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter Village / Area']) !!}
                                    @if($errors->has('area_vilage'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('area_vilage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('state', 'State', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                    {!! Form::select('state', $states, $user->state,['class' => 'form-control', 'id' => 'state', 'onchange' => 'selct_district(this.value)']); !!}
                                    @if($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('district', 'District', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                    {!! Form::select('district', ['' => 'Select Distrct', $user->city => $user->city], $user->city, ['class' => 'form-control', 'id' => 'district']); !!}
                                    @if($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('pincode', 'Pincode / Zip', ['class' => 'm-t-20 col-form-label text-md-right']) !!}
                                    {!! Form::text('pincode', $user->pincode, ['class' => 'form-control', 'id' => 'pincode', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter Pincode / Zip']) !!}
                                    @if($errors->has('pincode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pincode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-4">
                                    {!! Form::label('bank_name', 'Bank Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('bank_name', $user->bank_name, ['class' => 'form-control', 'id' => 'bank_name', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Bank Name']) !!}
                                
                                    @if($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('bank_branch', 'Bank Branch', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('bank_branch', $user->bank_branch, ['class' => 'form-control', 'id' => 'bank_branch', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Bank Branch']) !!}
                                
                                    @if($errors->has('bank_branch'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_branch') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('bank_acc_no', 'Bank Account No.', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('bank_acc_no', $user->bank_acc_no, ['class' => 'form-control', 'id' => 'bank_acc_no', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Bank Account No.']) !!}
                                
                                    @if($errors->has('bank_acc_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_acc_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('bank_ifsc_code', 'Bank IFSC Code', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('bank_ifsc_code', $user->bank_ifsc_code, ['class' => 'form-control', 'id' => 'bank_ifsc_code', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Bank IFSC Code']) !!}
                                
                                    @if($errors->has('bank_ifsc_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_ifsc_code') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="col-md-4">
                                    {!! Form::label('pancard_no', 'Pan Card Number', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('pancard_no', $user->pancard_no, ['class' => 'form-control', 'id' => 'pancard_no', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Pan Card Number']) !!}
                                
                                    @if($errors->has('pancard_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('pancard_no') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="col-md-4">
                                    {!! Form::label('aadhar_no', 'Aadhar Number', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('aadhar_no', $user->aadhar_no, ['class' => 'form-control', 'id' => 'aadhar_no', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Aadhar Number']) !!}
                                
                                    @if($errors->has('aadhar_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('aadhar_no') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="col-md-4">
                                    {!! Form::label('power', 'Bid Power', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('power', $user->power, ['class' => 'form-control', 'id' => 'power', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Enter your Aadhar Number']) !!}
                                
                                    @if($errors->has('power'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('power') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('aadhar_image', 'Aadhar Card', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::file('aadhar_image', ['class' => 'form-control', 'id' => 'aadhar_image']) !!}
                                
                                    @if ($errors->has('aadhar_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('aadhar_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('cheque_image', 'Cheque', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::file('cheque_image', ['class' => 'form-control', 'id' => 'cheque_image']) !!}
                                
                                    @if ($errors->has('cheque_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cheque_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-lg-12 m-t-20">
                                    <button class="btn btn-primary btn-block">Update Profile</button>
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
        });


    });

    function selct_district(a){if("SELECT STATE"==a){$("#district").html("")}if("Andhra Pradesh"==a){var r=["Anantapur","Chittoor","East Godavari","Guntur","Krishna","Kurnool","Prakasam","Srikakulam","SriPotti Sri Ramulu Nellore","Vishakhapatnam","Vizianagaram","West Godavari","Cudappah"];$(function(){for(var a="",i=0;i<r.length;i++)a+='<option value="'+r[i]+'">'+r[i]+"</option>";$("#district").html(a)})}if("Arunachal Pradesh"==a){var i=["Anjaw","Changlang","Dibang Valley","East Siang","East Kameng","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Papum Pare","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang"];$(function(){for(var a="",r=0;r<i.length;r++)a+='<option value="'+i[r]+'">'+i[r]+"</option>";$("#district").html(a)})}if("Assam"==a){var n=["Baksa","Barpeta","Bongaigaon","Cachar","Chirang","Darrang","Dhemaji","Dima Hasao","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Jorhat","Kamrup","Kamrup Metropolitan","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Morigaon","Nagaon","Nalbari","Sivasagar","Sonitpur","Tinsukia","Udalguri"];$(function(){for(var a="",r=0;r<n.length;r++)a+='<option value="'+n[r]+'">'+n[r]+"</option>";$("#district").html(a)})}if("Bihar"==a){var h=["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur (Bhabua)","Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Pashchim Champaran","Patna","Purbi Champaran","Purnia","Rohtas","Saharsa","Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali"];$(function(){for(var a="",r=0;r<h.length;r++)a+='<option value="'+h[r]+'">'+h[r]+"</option>";$("#district").html(a)})}if("Chhattisgarh"==a){var t=["Bastar","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Jashpur","Janjgir-Champa","Korba","Koriya","Kanker","Kabirdham (formerly Kawardha)","Mahasamund","Narayanpur","Raigarh","Rajnandgaon","Raipur","Surajpur","Surguja"];$(function(){for(var a="",r=0;r<t.length;r++)a+='<option value="'+t[r]+'">'+t[r]+"</option>";$("#district").html(a)})}if("Dadra and Nagar Haveli"==a){var o=["Amal","Silvassa"];$(function(){for(var a="",r=0;r<o.length;r++)a+='<option value="'+o[r]+'">'+o[r]+"</option>";$("#district").html(a)})}if("Daman and Diu"==a){var u=["Daman","Diu"];$(function(){for(var a="",r=0;r<u.length;r++)a+='<option value="'+u[r]+'">'+u[r]+"</option>";$("#district").html(a)})}if("Delhi"==a){var l=["Delhi","New Delhi","North Delhi","Noida","Patparganj","Sonabarsa","Tughlakabad"];$(function(){for(var a="",r=0;r<l.length;r++)a+='<option value="'+l[r]+'">'+l[r]+"</option>";$("#district").html(a)})}if("Goa"==a){var e=["Chapora","Dabolim","Madgaon","Marmugao (Marmagao)","Panaji Port","Panjim","Pellet Plant Jetty/Shiroda","Talpona","Vasco da Gama"];$(function(){for(var a="",r=0;r<e.length;r++)a+='<option value="'+e[r]+'">'+e[r]+"</option>";$("#district").html(a)})}if("Gujarat"==a){var d=["Ahmedabad","Amreli district","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Dahod","Dang","Gandhinagar","Jamnagar","Junagadh","Kutch","Kheda","Mehsana","Narmada","Navsari","Patan","Panchmahal","Porbandar","Rajkot","Sabarkantha","Surendranagar","Surat","Tapi","Vadodara","Valsad"];$(function(){for(var a="",r=0;r<d.length;r++)a+='<option value="'+d[r]+'">'+d[r]+"</option>";$("#district").html(a)})}if("Haryana"==a){var p=["Ambala","Bhiwani","Faridabad","Fatehabad","Gurgaon","Hissar","Jhajjar","Jind","Karnal","Kaithal","Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamuna Nagar"];$(function(){for(var a="",r=0;r<p.length;r++)a+='<option value="'+p[r]+'">'+p[r]+"</option>";$("#district").html(a)})}if("Himachal Pradesh"==a){var g=["Baddi","Baitalpur","Chamba","Dharamsala","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul & Spiti","Mandi","Simla","Sirmaur","Solan","Una"];$(function(){for(var a="",r=0;r<g.length;r++)a+='<option value="'+g[r]+'">'+g[r]+"</option>";$("#district").html(a)})}if("Jammu and Kashmir"==a){var m=["Jammu","Leh","Rajouri","Srinagar"];$(function(){for(var a="",r=0;r<m.length;r++)a+='<option value="'+m[r]+'">'+m[r]+"</option>";$("#district").html(a)})}if("Jharkhand"==a){var s=["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribag","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu","Ramgarh","Ranchi","Sahibganj","Seraikela Kharsawan","Simdega","West Singhbhum"];$(function(){for(var a="",r=0;r<s.length;r++)a+='<option value="'+s[r]+'">'+s[r]+"</option>";$("#district").html(a)})}if("Karnataka"==a){var v=["Bagalkot","Bangalore","Bangalore Urban","Belgaum","Bellary","Bidar","Bijapur","Chamarajnagar","Chikkamagaluru","Chikkaballapur","Chitradurga","Davanagere","Dharwad","Dakshina Kannada","Gadag","Gulbarga","Hassan","Haveri district","Kodagu","Kolar","Koppal","Mandya","Mysore","Raichur","Shimoga","Tumkur","Udupi","Uttara Kannada","Ramanagara","Yadgir"];$(function(){for(var a="",r=0;r<v.length;r++)a+='<option value="'+v[r]+'">'+v[r]+"</option>";$("#district").html(a)})}if("Kerala"==a){var f=["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thrissur","Thiruvananthapuram","Wayanad"];$(function(){for(var a="",r=0;r<f.length;r++)a+='<option value="'+f[r]+'">'+f[r]+"</option>";$("#district").html(a)})}if("Madhya Pradesh"==a){var c=["Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhilai","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Dewas","Dhar","Guna","Gwalior","Hoshangabad","Indore","Itarsi","Jabalpur","Khajuraho","Khandwa","Khargone","Malanpur","Malanpuri (Gwalior)","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Pithampur","Raipur","Raisen","Ratlam","Rewa","Sagar","Satna","Sehore","Seoni","Shahdol","Singrauli","Ujjain"];$(function(){for(var a="",r=0;r<c.length;r++)a+='<option value="'+c[r]+'">'+c[r]+"</option>";$("#district").html(a)})}if("Maharashtra"==a){var S=["Ahmednagar","Akola","Alibag","Amaravati","Arnala","Aurangabad","Aurangabad","Bandra","Bassain","Belapur","Bhiwandi","Bhusaval","Borliai-Mandla","Chandrapur","Dahanu","Daulatabad","Dighi (Pune)","Dombivali","Goa","Jaitapur","Jalgaon","Jawaharlal Nehru (Nhava Sheva)","Kalyan","Karanja","Kelwa","Khopoli","Kolhapur","Lonavale","Malegaon","Malwan","Manori","Mira Bhayandar","Miraj","Murad","Nagapur","Nagpur","Nalasopara","Nanded","Nandgaon","Nasik","Mumbai","Nhave","Osmanabad","Palghar","Panvel","Pimpri","Pune","Ratnagiri","Sholapur","Shrirampur","Shriwardhan","Tarapur","Thana","Thane","Trombay","Varsova","Vengurla","Virar","Wada"];$(function(){for(var a="",r=0;r<S.length;r++)a+='<option value="'+S[r]+'">'+S[r]+"</option>";$("#district").html(a)})}if("Manipur"==a){var B=["Bishnupur","Churachandpur","Chandel","Imphal East","Senapati","Tamenglong","Thoubal","Ukhrul","Imphal West"];$(function(){for(var a="",r=0;r<B.length;r++)a+='<option value="'+B[r]+'">'+B[r]+"</option>";$("#district").html(a)})}if("Meghalaya"==a){var K=["Baghamara","Balet","Barsora","Bolanganj","Dalu","Dawki","Ghasuapara","Mahendraganj","Moreh","Ryngku","Shella Bazar","Shillong"];$(function(){for(var a="",r=0;r<K.length;r++)a+='<option value="'+K[r]+'">'+K[r]+"</option>";$("#district").html(a)})}if("Mizoram"==a){var k=["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"];$(function(){for(var a="",r=0;r<k.length;r++)a+='<option value="'+k[r]+'">'+k[r]+"</option>";$("#district").html(a)})}if("Nagaland"==a){var b=["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];$(function(){for(var a="",r=0;r<b.length;r++)a+='<option value="'+b[r]+'">'+b[r]+"</option>";$("#district").html(a)})}if("Orissa"==a){var M=["Bahabal Pur","Bhubaneswar","Chandbali","Gopalpur","Jeypore","Paradip Garh","Puri","Rourkela"];$(function(){for(var a="",r=0;r<M.length;r++)a+='<option value="'+M[r]+'">'+M[r]+"</option>";$("#district").html(a)})}if("Puducherry"==a){var P=["Karaikal","Mahe","Pondicherry","Yanam"];$(function(){for(var a="",r=0;r<P.length;r++)a+='<option value="'+P[r]+'">'+P[r]+"</option>";$("#district").html(a)})}if("Punjab"==a){var D=["Amritsar","Barnala","Bathinda","Firozpur","Faridkot","Fatehgarh Sahib","Fazilka","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Sri Muktsar Sahib","Pathankot","Patiala","Rupnagar","Ajitgarh (Mohali)","Sangrur","Shahid Bhagat Singh Nagar","Tarn Taran"];$(function(){for(var a="",r=0;r<D.length;r++)a+='<option value="'+D[r]+'">'+napunjabgaland[r]+"</option>";$("#district").html(a)})}if("Rajasthan"==a){var w=["Ajmer","Alwar","Banswara","Baran","Barmer","Bharatpur","Bhilwara","Bikaner","Bundi","Chittorgarh","Churu","Dausa","Dholpur","Dungarpur","Ganganagar","Hanumangarh","Jaipur","Jaisalmer","Jalore","Jhalawar","Jhunjhunu","Jodhpur","Karauli","Kota","Nagaur","Pali","Pratapgarh","Rajsamand","Sawai Madhopur","Sikar","Sirohi","Tonk","Udaipur"];$(function(){for(var a="",r=0;r<w.length;r++)a+='<option value="'+w[r]+'">'+w[r]+"</option>";$("#district").html(a)})}if("Sikkim"==a){var j=["Chamurci","Gangtok"];$(function(){for(var a="",r=0;r<j.length;r++)a+='<option value="'+j[r]+'">'+j[r]+"</option>";$("#district").html(a)})}if("Tamil Nadu"==a){var A=["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Mandapam","Nagapattinam","Nilgiris","Namakkal","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Thiruvallur","Tirupur","Tiruchirapalli","Theni","Tirunelveli","Thanjavur","Thoothukudi","Tiruvallur","Tiruvannamalai","Vellore","Villupuram","Viruthunagar"];$(function(){for(var a="",r=0;r<A.length;r++)a+='<option value="'+A[r]+'">'+A[r]+"</option>";$("#district").html(a)})}if("Telangana"==a){var N=["Adilabad","Hyderabad","Karimnagar","Mahbubnagar","Medak","Nalgonda","Nizamabad","Ranga Reddy","Warangal"];$(function(){for(var a="",r=0;r<N.length;r++)a+='<option value="'+N[r]+'">'+N[r]+"</option>";$("#district").html(a)})}if("Tripura"==a){var C=["Agartala","Dhalaighat","Kailashahar","Kamalpur","Kanchanpur","Kel Sahar Subdivision","Khowai","Khowaighat","Mahurighat","Old Raghna Bazar","Sabroom","Srimantapur"];$(function(){for(var a="",r=0;r<C.length;r++)a+='<option value="'+C[r]+'">'+C[r]+"</option>";$("#district").html(a)})}if("Uttar Pradesh"==a){var G=["Almora","Bageshwar","Chamoli","Champawat","Dehradun","Haridwar","Nainital","Pauri Garhwal","Pithoragarh","Rudra Prayag","Tehri Garhwal","Udam Singh Nagar","Uttar Kashi","Agra","Aligarh","Allahabad","Ambedkar Nagar","Amethi","Amroha","Auraiya","Azamgarh","Baghpat","Bahraich","Ballia","Balrampur","Banda","Barabanki","Bareilly","Basti","Bhadohi","Bijnor","Budaun","Bulandshahr","Chandauli","Chitrakoot","Deoria","Etah","Etawah","Faizabad","Farrukhabad","Fatehpur","Firozabad","Gautam Buddha Nagar","Ghaziabad","Ghazipur","Gonda","Gorakhpur","Hamirpur","Hapur","Hardoi","Hathras","Jalaun","Jaunpur","Jhansi","Kannauj","Kanpur Dehat","Kanpur Nagar","Kasganj","Kaushambi","Kheri","Kushi Nagar","Lalitpur","Lucknow","Maharajganj","Mahoba","Mainpuri","Mathura","Mau","Meerut","Mirzapur","Moradabad","Muzaffarn Agar","Pilibhit","Pratapgarh","Rae Bareli","Rampur","Saharanpur","Sambhal","Sant Kabeer Nagar","Shahjahanpur","Shamli","Shravasti","Siddhart Nagar","Sitapur","Sonbhadra","Sultanpur","Unnao","Varanasi"];$(function(){for(var a="",r=0;r<G.length;r++)a+='<option value="'+G[r]+'">'+G[r]+"</option>";$("#district").html(a)})}if("Uttarakhand"==a){var T=["Almora","Badrinath","Bangla","Barkot","Bazpur","Chamoli","Chopra","Dehra Dun","Dwarahat","Garhwal","Haldwani","Hardwar","Haridwar","Jamal","Jwalapur","Kalsi","Kashipur","Mall","Mussoorie","Nahar","Naini","Pantnagar","Pauri","Pithoragarh","Rameshwar","Rishikesh","Rohni","Roorkee","Sama","Saur"];$(function(){for(var a="",r=0;r<T.length;r++)a+='<option value="'+T[r]+'">'+T[r]+"</option>";$("#district").html(a)})}if("West Bengal"==a){var R=["Alipurduar","Bankura","Bardhaman","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah","Jalpaiguri","Kolkata","Maldah","Murshidabad","Nadia","North 24 Parganas","Paschim Medinipur","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"];$(function(){for(var a="",r=0;r<R.length;r++)a+='<option value="'+R[r]+'">'+R[r]+"</option>";$("#district").html(a)})}}
</script>
@endsection
