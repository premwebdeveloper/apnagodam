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
                url: "{{ route('otpVerification') }}",
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
            url: "{{ route('otpResend') }}",
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
            <h3>{{ __('Login') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Login</a>
        </div>
    </div>
</section>
<section class="contact_form_area2 p-t-50 p-b-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="single_title p-10 text-center">Get Started</h3>
                <hr>
                <h5 class="text-center">Thank you for showing interest in Apnagodam. Please enter your mobile number to get started.</h2><br>
                <div class="row p-t-30">
                    @if(session('status'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{$errors->first()}}
                        </div>
                    @endif
                    @if(isset($otp))
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="alert alert-warning" style="display: none;" id="otpMatched">Enter 6 digit OTP !</div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <form method="POST" autocomplete="false" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    @csrf
                                    <h6 id="resuend_otp_msg" class="col-md-12 text-center" style="display:none;color: green;">
                                        OTP Resend Sucessfully.
                                    </h6>
                                    <label for="otp" class="col-sm-12 col-form-label text-md-right">Enter 6 digit OTP code sent to your mobile number</label>

                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <input id="exist_phone" autocomplete="false" type="hidden" value="{{ $exist_phone }}" name="phone" required>
                                        <input id="password" autocomplete="new-password" type="hidden" value="123456" name="password" required>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <a class="btn btn-danger" id="resendotp">
                                                    {{ __('Resend OTP') }}
                                                </a>
                                                <button type="submit" class="btn btn-success" id="verifyButton">
                                                    {{ __('Verify OTP') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    @else
                        <form method="POST" class="contact_us_form" action="{{ route('verifyOtp') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-4">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" placeholder="Enter your Mobile Number" value="{{ old('phone') }}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn submit_blue form-control">Send OTP <i class="fa fa-angle-right"></i></button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
