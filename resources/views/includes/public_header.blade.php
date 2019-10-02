  <body>

<?php
    $terminals = DB::table('warehouses')
            ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area',  'warehouse_rent_rates.district',  'warehouse_rent_rates.area_sqr_ft',  'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt')
            ->where('warehouses.status', 1)
            ->get();
?>
    <!-- Navigation -->
    <marquee class="b-clr" scrollamount="3">
        <img class="blink-image" src="{{ asset('resources/frontend_assets/img/apna-godam-top-img.png') }}">
    </marquee>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" style="/*background-color: rgba(0,0,0,.4)*/background-color: #00C0F5;padding:0px;margin-top: -6px;">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" style="padding:0px; " href="{{ url('/')}}">
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
                        <a class="btn btn-secondary" href="{{ route('farmer_login') }}" >Seller Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ route('trader_login') }}" >Buyer Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('login') }}" >Admin Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </li>
                    @else
                        @if(Auth::user()->id != 1)

                            <!-- <li class="nav-item">
                                <a href="{{ route('notifications') }}" class="nav-link js-scroll-trigger"><i class="fa fa-bell"></i></a>
                            </li> -->

                            <li class="nav-item dropdown">
                                <a class="nav-link js-scroll-trigger" href="">
                                    <span class="fa fa-user"></span> {{ Auth::user()->fname }}
                                </a>
                                <div class="dropdown-content">
                                    <!-- <a href="{{ route('user_dashboard') }}">Dashboard</a> -->
                                    <a href="{{ route('profile') }}">Profile</a>
                                    <a href="{{ route('inventories') }}">My Commodity</a>
                                    @php
                                        $user = DB::table('user_roles')->where('user_id', Auth::user()->id)->first();
                                        $role_id = $user->role_id;

                                        if($role_id == 5):
                                    @endphp
                                        <a href="{{ route('deals') }}">My Sell</a>
                                    @php
                                        elseif($role_id == 6):
                                    @endphp
                                        <a href="{{ route('buy_sell') }}">Market</a>
                                        <a href="{{ route('deals') }}">My Purchase</a>
                                    @php
                                        endif;
                                    @endphp

                                    <!-- <a href="{{ route('user_finance_view') }}">Finance</a> -->
                                    <!-- <a href="{{ route('change_password') }}">Change Password</a> -->
                                    <!-- <a href="javascript:;">Notifications</a> -->

                                    <!-- <a href="{{ route('deals') }}">Notifications </a> -->
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
                        <a class="tel-icon nav-link js-scroll-trigger" href="tel:+91-9314142089" style="background: none;color:#000!important">+91-9314142089</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>  <!-- naivigation ends -->
    <nav style="height: 50px; background:#f3f5f7;text-align: center" class="navbar navbar-expand-lg navbar-light bottom-navbar">
        <ul class="navbar-nav">
            @foreach($terminals as $terminal)
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('terminal_view', ['id' => $terminal->id]) !!}"><?= $terminal->address; ?></a>
                </li>
            @endforeach
        </ul>
    </nav>
    <style type="text/css">
        .bottom-navbar .nav-item{
            padding: 0px 0px;
            font-size: 13px;
            font-weight: 500;
            border-right: 2px solid lightgray;
        }
        .bottom-navbar .nav-item a{
            color: #000!important;
        }
        /* Firefox old*/
        @-moz-keyframes blink {
            0% {
                opacity:1;
            }
            50% {
                opacity:0;
            }
            100% {
                opacity:1;
            }
        } 

        @-webkit-keyframes blink {
            0% {
                opacity:1;
            }
            50% {
                opacity:0;
            }
            100% {
                opacity:1;
            }
        }
        /* IE */
        @-ms-keyframes blink {
            0% {
                opacity:1;
            }
            50% {
                opacity:0;
            }
            100% {
                opacity:1;
            }
        } 
        /* Opera and prob css3 final iteration */
        @keyframes blink {
            0% {
                opacity:1;
            }
            50% {
                opacity:0;
            }
            100% {
                opacity:1;
            }
        } 
        .blink-image {
            -moz-animation: blink normal 0.2s infinite ease-in-out; /* Firefox */
            -webkit-animation: blink normal 0.2s infinite ease-in-out; /* Webkit */
            -ms-animation: blink normal 0.2s infinite ease-in-out; /* IE */
            animation: blink normal 0.2s infinite ease-in-out; /* Opera and prob css3 final iteration */
            height: 40px;
        }
        .b-clr{
            background-color: #efefef;
        }
        li.nav-item {
            text-align: center;
        }
    </style>