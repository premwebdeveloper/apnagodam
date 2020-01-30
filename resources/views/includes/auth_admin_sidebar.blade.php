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
                <div class="logo-element p-t-0" style="padding-bottom: 0px!important;">
                    <img style="width: 100%;" src="{{ asset('resources/frontend_assets/img/apna-godam-logo-1.png') }}">
                </div>
                <div class="dropdown profile-element text-center">
                    <span>
                        @if($role->role_id == 1)
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/upload/profile_image/admin.png') }}" style="background: #fff;width: 100px;"/>
                        @else
                        <img alt="image" class="img-circle" src="{{ asset('resources/assets/upload/profile_image/') }}/{{ ($details->image)?$details->image:'admin.png' }}" style="background: #fff;width: 100px;"/>
                        @endif
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->fname }}</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li>
                            <a href="{{ route('/') }}">
                                <i class="fa fa-globe" aria-hidden="true"></i> Go to Website
                            </a>
                        </li>
                        @if($role->role_id == 2)
                            <li>
                                <a href="{{ route('profile') }}">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> My Profile
                                </a>
                            </li>
                        @endif
                        <!-- <li>
                            <a href="{{ route('change_password_view') }}">
                                <i class="fa fa-key" aria-hidden="true"></i> Change Password
                            </a>
                        </li> -->
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
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-th-large" title="Dashboard"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            @if($role->role_id == 2)
            <li>
                <a href="{{ route('inventories') }}" title="My Commodity" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="nav-label">My Commodity</span>
                </a>
            </li>
            <li>
                <a href="{{ route('deals', ['status' => 'sell']) }}"  title="My Sell" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-cloud-upload"></i>
                    <span class="nav-label">My Sell</span>
                </a>
            </li>
            <li>
                <a href="{{ route('deals', ['status' => 'purchase']) }}"  title="My Purchase" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">My Purchase</span>
                </a>
            </li>
            <li>
                <a href="{{ route('buy_sell') }}" title="Market" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-bar-chart"></i>
                    <span class="nav-label">Market</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user_finance_view') }}" title="Finance / Loan" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-money"></i>
                    <span class="nav-label">Finance / Loan</span>
                </a>
            </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('mandi_place_name') }}">
                        <i class="fa fa-building-o" title=""></i>
                        <span class="nav-label">Mandi Database</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('today_price') }}">
                        <i class="fa fa-inr" title=""></i>
                        <span class="nav-label">Today's Price</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('mandi_samiti') }}">
                        <i class="fa fa-building" title=""></i>
                        <span class="nav-label">Mandi Samiti</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('warehouses') }}">
                        <i class="fa fa-bank" title=""></i>
                        <span class="nav-label">Terminals</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('facilitiy_master') }}">
                        <i class="fa fa-cog" title=""></i>
                        <span class="nav-label">Facilities Master</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('terminal_enquires') }}">
                        <i class="fa fa-envelope" title=""></i>
                        <span class="nav-label">Terminal Enquiries</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('users') }}">
                        <i class="fa fa-users" title=""></i>
                        <span class="nav-label">Users</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('category') }}">
                        <i class="fa fa-list-alt" title=""></i>
                        <span class="nav-label">Category / Commodity</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('inventory') }}">
                        <i class="fa fa-houzz" title=""></i>
                        <span class="nav-label">Inventory</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('finance') }}">
                        <i class="fa fa-money" title=""></i>
                        <span class="nav-label">Finance / Loan</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('bank_master') }}">
                        <i class="fa fa-bank" title=""></i>
                        <span class="nav-label">Bank Master</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('enquiries') }}">
                        <i class="fa fa-send-o" title=""></i>
                        <span class="nav-label">Enquiries</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1 || $role->role_id == 4)
                <li>
                    <a href="{{ route('done_deals') }}">
                        <i class="fa fa-handshake-o" title=""></i>
                        <span class="nav-label">Deals</span>
                    </a>
                </li>
            @endif
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('users_otp') }}">
                        <i class="fa fa-key" title=""></i>
                        <span class="nav-label">User's OTP</span>
                    </a>
                </li>
            @endif
		</ul>
	</div>
</nav>