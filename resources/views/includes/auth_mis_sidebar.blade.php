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
                        @if($role->role_id != 2 && $role->role_id != 4 )
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
            @if($role->role_id == 1)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-th-large" title="Dashboard"></i>
                        <span class="nav-label">Back to Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees') }}">
                        <i class="fa fa-users" title=""></i>
                        <span class="nav-label">Employees</span>
                    </a>
                </li>
            @endif
            
            @if($role->role_id == 1 || $role->role_id == 3 || $role->role_id == 6 || $role->role_id == 8 || $role->role_id == 9)
                <li>
                    <a href="{{ route('leads') }}">
                        <i class="fa fa-book" title=""></i>
                        <span class="nav-label">Lead Generate</span>
                    </a>
                </li>
            @endif
		</ul>
	</div>
</nav>