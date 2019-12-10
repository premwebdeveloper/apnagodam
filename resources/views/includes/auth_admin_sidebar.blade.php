<style type="text/css">
    .nav-header
    {
        padding: 15px 25px;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/upload/profile_image/admin.png') }}" style="background: #fff;width: 100px;"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Apna Godam</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('/') }}">
                                <i class="fa fa-globe" aria-hidden="true"></i> Go to website
                            </a>
                        </li>
                        <!--
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-user" aria-hidden="true"></i> Profile
                            </a>
                        </li>
                        -->
                        <li>
                            <a href="{{ route('change_password_view') }}">
                                <i class="fa fa-key" aria-hidden="true"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="active">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mandi_place_name') }}">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-label">Mandi Database</span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route('commodity_name') }}">
                    <i class="fa fa-code"></i>
                    <span class="nav-label">Commodity Name</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route('today_price') }}">
                    <i class="fa fa-inr"></i>
                    <span class="nav-label">Today's Price</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mandi_samiti') }}">
                    <i class="fa fa-building"></i>
                    <span class="nav-label">Mandi Samiti</span>
                </a>
            </li>
            <li>
                <a href="{{ route('warehouses') }}">
                    <i class="fa fa-building"></i>
                    <span class="nav-label">Terminals</span>
                </a>
            </li>
            <li>
                <a href="{{ route('facilitiy_master') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Facilities Master</span>
                </a>
            </li>
            <li>
                <a href="{{ route('terminal_enquires') }}">
                    <i class="fa fa-envelope"></i>
                    <span class="nav-label">Terminal Enquiries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users') }}">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">Users</span>
                </a>
            </li>

            <li>
                <a href="{{ route('category') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">Cateogry / Commodity</span>
                </a>
            </li>

            <li>
                <a href="{{ route('inventory') }}">
                    <i class="fa fa-houzz"></i>
                    <span class="nav-label">Inventory</span>
                </a>
            </li>

            <li>
                <a href="{{ route('finance') }}">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Finance / Loan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bank_master') }}">
                    <i class="fa fa-building"></i>
                    <span class="nav-label">Bank Master</span>
                </a>
            </li>
            <li>
                <a href="{{ route('enquiries') }}">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">Enquiries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('done_deals') }}">
                    <i class="fa fa-flag"></i>
                    <span class="nav-label">Deals</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users_otp') }}">
                    <i class="fa fa-flag"></i>
                    <span class="nav-label">User's OTP</span>
                </a>
            </li>

		</ul>
	</div>
</nav>