  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <img class="head-logo" src="{{ asset('resources/frontend_assets/img/paytm-logo.png') }}" style="width: 160px;">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="javaScript:;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="javaScript:;">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="javaScript:;">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="javaScript:;">CONTACT US</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="btn btn-primary" href="#Login" data-toggle="modal">Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </li>
                    @else
                        @if(Auth::user()->id != 1)
                            <li class="nav-item dropdown"><a class="nav-link js-scroll-trigger" href=""><span class="fa fa-user"></span> {{ $user->fname }}</a>
                                <div class="dropdown-content">
                                    <a href="#">Dashboard</a>
                                    <a href="#">Profile</a>
                                    <a href="{{ route('inventory') }}">Inventory</a>
                                    <a href="#">Change Password</a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> Go to dashboard</a></li>
                        @endif

                    @endif
                    <li class="nav-item">
                        <a class="tel-icon nav-link js-scroll-trigger" href="tel:+91-9314142089">+91-9314142089</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  <!-- naivigation ends -->
<!-- Modal -->
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body mx-3">

                    <div style="text-align: -webkit-center;">
                        <img src="{{ asset('resources/frontend_assets/img/paytm-logo.png') }}" class="img-responsive" style="width: 150px;margin-bottom: 20px;">
                    </div>

                    <div class="md-form mb-5{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
                        <input id="email" placeholder="Email Address" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                        <input id="password" type="password" placeholder="*******" class="form-control" name="password" required>
                                
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

