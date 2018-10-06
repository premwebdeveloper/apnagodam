  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background-color: rgba(0,0,0,.4);">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ url('/')}}">
                <img class="head-logo" src="{{ asset('resources/frontend_assets/img/apna-godam-logo-1.png') }}" style="width: 100px;">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('/')}}#services">Services</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('our-team') }}">Our Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('contact-us') }}">CONTACT US</a>
                    </li>
                    
                    @guest
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}" >Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </li>
                    @else
                        @if(Auth::user()->id != 1)

                            <li class="nav-item">
                                <a href="{{ route('notifications') }}" class="nav-link js-scroll-trigger"><i class="fa fa-bell"></i></a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="">
                                    <span class="fa fa-user"></span> {{ Auth::user()->fname }} 
                                </a>
                                <div class="dropdown-content">
                                    <!-- <a href="{{ route('user_dashboard') }}">Dashboard</a> -->
                                    <a href="{{ route('profile') }}">Profile</a>
                                    <a href="{{ route('inventories') }}">Inventories</a>
                                    <a href="{{ route('user_finance_view') }}">Finance</a>
                                    <!-- <a href="{{ route('change_password') }}">Change Password</a> -->
                                    <!-- <a href="javascript:;">Notifications</a> -->
                                    <a href="{{ route('deals') }}">Purchase / Sell</a>
                                    <a href="{{ route('deals') }}">Notifications </a>
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