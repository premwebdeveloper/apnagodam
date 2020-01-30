<?php
    $terminals = DB::table('warehouses')->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')->where('warehouses.status', 1)->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location')->get();
?>
<!-- Navigation -->
<header class="main_header_area">
    <marquee class="b-clr" scrollamount="3">
        <img class="blink-image" src="{{ asset('resources/frontend_assets/img/apna-godam-top-img.png') }}">
    </marquee>
    <div class="header_top">
        <div class="container">
            <div class="pull-left">
                <a href="{{ url('/') }}"><img style="width: 100px;" src="{{ asset('resources/frontend_assets/img/logo-img.png') }}" alt=""></a>
            </div>
            <div class="pull-right">
                <div class="header_c_text">
                    <h5>Call us</h5>
                    <h4>+91-9314142089</h4>
                </div>
                <div class="header_c_text">
                    <h5>Email Us</h5>
                    <h4>contact@apnagodam.com</h4>
                </div>
                <div class="header_c_text">
                    <h5>IVR Number</h5>
                    <h4>7733901154</h4>
                </div>
                <div class="header_c_text">
                    @if(Auth::user())
                        <a class="quote_btn" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="quote_btn" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @else
                        <a class="quote_btn" href="{{ route('login') }}">Login</a>
                        <a class="quote_btn" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu_area">
        <nav class="navbar navbar-default">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        <li>
                            <a href="{{ route('about-us') }}">About Us</a>
                        </li>
                        <li class="dropdown submenu">
                            <a href="{{ route('terminals') }}" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Terminals <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                @foreach($terminals as $terminal)
                                    <li><a href="{!! route('terminal_view', ['id' => $terminal->id]) !!}">{!! $terminal->name !!} ({!! $terminal->location !!})</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li >
                            <a href="{{ route('our-team') }}">Our Team</a>
                        </li>
                        <li >
                            <a href="{{ route('contact-us') }}">CONTACT US</a>
                        </li>
                        <li >
                            <a href="{{ route('faq') }}">FAQ's</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<style type="text/css">
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
        height: 35px;
    }
    .b-clr{
        background-color: #efefef;
    }
    li.nav-item {
        text-align: center;
    }
</style>