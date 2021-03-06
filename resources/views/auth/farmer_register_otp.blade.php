@extends('layouts.public_app')

@section('content')

<script>
$(document).ready(function(){

    $('#verifyButton').prop('disabled', true);

    // OTP verification on keyUP
    $(document).on('keyup', '#otp', function(){

        var otp_length = $('#otp').val().length;

        if(otp_length == 6){

            $('#otpMatched').hide();

            var otp = $('#otp').val();
            var exist_phone = $('#exist_phone').val();

            $.ajax({
                method : 'post',
                url: "{{ route('otpRegisterVerification') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'otp' : otp, 'exist_phone' : exist_phone},
                success:function(response){

                    console.log(response);

                    if(response == 0)
                    {
                        $('#verifyButton').prop('disabled', true);
                    }
                    else if(response == 1)
                    {
                        $('#verifyButton').prop('disabled', false);
                    }
                    else if(response == 2)
                    {
                        $('#otpMatched').html('');
                        $('#otpMatched').html('OTP did not match!');
                        $('#otpMatched').show();

                        $('#verifyButton').prop('disabled', true);
                    }
                },
                error: function(data){
                    console.log(data);
                },
            });

        }
        else{

            $('#verifyButton').prop('disabled', true);
            $('#otpMatched').show();
        }
    });

    //Resend OTP
    $(document).on('click', '#resendotp', function(){
        var exist_phone = $('#exist_phone').val();
        $.ajax({
            method : 'post',
            url: "{{ route('registerOTPResend') }}",
            async : true,
            data : {"_token": "{{ csrf_token() }}", 'exist_phone' : exist_phone},
            success:function(response){
                console.log(response);
                $('#resuend_otp_msg').show('');

            },
            error: function(data){
                console.log(data);
            },
        });
    });

});
</script>
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Seller Registration') }}</h3>
        </div>
        <div class="pull-right">
            <a href="{{ url('/') }}">Home</a>
            <a >Seller Registration</a>
        </div>
    </div>
</section>
<section id="about">

    <div class="container">
        @if(session('status'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="row text-center m-t-40 m-b-40">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="section-heading text-center">{{ __('Seller Registration') }}</h2>
                <hr>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{$errors->first()}}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if(isset($otp))

                            <div class="alert alert-warning" style="display: none;" id="otpMatched">Enter 6 digit OTP !</div>

                            <form method="POST" action="{{ route('registerLogin') }}" aria-label="{{ __('Login') }}">
                                @csrf

                                <div class="form-group row">
                                    <h6 id="resuend_otp_msg" style="display:none;color: green;">
                                        OTP Resend Sucessfully.
                                    </h6>

                                    <label for="otp" class="col-sm-12 col-form-label text-md-right">Enter 6 digit OTP code sent to your mobile number</label>

                                    <div class="col-md-8 col-md-offset-2">
                                        <input id="otp" style="margin-bottom:8px;" type="number" class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" value="{{ old('otp') }}" placeholder="OTP" required autofocus>

                                        @if ($errors->has('otp'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('otp') }}</strong>
                                            </span>
                                        @endif
                                        <span style="color: red;">
                                            OTP will expire in 1 Min.
                                        </span>
                                    </div>
                                </div>

                                <input id="exist_phone" type="hidden" value="{{ $exist_phone }}" name="phone" required>
                                <input id="password" type="hidden" value="123456" name="password" required>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <a class="btn btn-danger" id="resendotp">
                                            Resend OTP
                                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-success" id="verifyButton">
                                            {{ __('Verify OTP') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
