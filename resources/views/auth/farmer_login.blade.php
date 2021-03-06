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
        alert(exist_phone);
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

<header class="masthead text-white d-flex masthalf"></header>
@if(session('info_msg'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
    </script>
@endif
<section id="about">

    <div class="container">
        @if(session('status'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="section-heading text-center">{{ __('Seller Login') }}</h2>
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

                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf

                                <div class="form-group row">
                                    <h6 id="resuend_otp_msg" style="display:block;color: green;">
                                        OTP Resend Sucessfully.
                                    </h6>

                                    <label for="otp" class="col-sm-4 col-form-label text-md-right">Enter 6 digit OTP code sent to your mobile number</label>

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
                                </div>

                                <input id="exist_phone" type="hidden" value="{{ $exist_phone }}" name="phone" required>
                                <input id="password" type="hidden" value="123456" name="password" required>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <a class="btn btn-warning" id="resend_otp">
                                            Resend OTP
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="verifyButton">
                                            {{ __('Verify OTP') }}
                                        </button>
                                    </div>
                                </div>

                            </form>

                        @else

                            <form method="POST" action="{{ route('verifyOtp') }}" aria-label="{{ __('Login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" placeholder="Mobile Number" value="{{ old('phone') }}" required autofocus>

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        <a class="btn btn-link" href="{{ route('farmer_register') }}">
                                            New User? Register Here.
                                        </a>
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

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body text-center" style="padding: 20px;">
            <img src="{{ asset('resources/frontend_assets/img/check.png') }}" style="max-height: 120px;"><br/><br/>
            <h3>बधाई हो !!</h3><br/>
            <p>आपका 10 लाख का कमोडिटी लोन स्वीकृत हो गया है ,अपने नजदीकी गोदाम में माल भेज कर लोन राशि खाते में प्राप्त करे !</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
      </div>

    </div>
  </div>
</div>
<style type="text/css">
    
.modal-content {
    background: #fff!important; 
}
</style>
@endsection
