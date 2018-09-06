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
                        <img alt="image" class="img-circle" src="resources/assets/images/sad.png" style="background: #fff;width: 100px;"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Milk</strong>
                        <b class="caret"></b> </span>  </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('/') }}"> <i class="fa fa-globe" aria-hidden="true"></i> Go to website </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-user" aria-hidden="true"></i> Profile </a></li>
                        <li><a href="javascript:;"> <i class="fa fa-key" aria-hidden="true"></i> Change Password </a></li>
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
                <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li><a href="{{route('users')}}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a></li>
            <li><a href="{{route('Category')}}"><i class="fa fa-users"></i> <span class="nav-label">Product Category</span></a></li>
            <li><a href="{{route('subCategory')}}"><i class="fa fa-users"></i> <span class="nav-label">Product Type</span></a></li>
            <li><a href="{{route('Weight')}}"><i class="fa fa-users"></i> <span class="nav-label">Weight</span></a></li>
            <li><a href="{{route('Product')}}"><i class="fa fa-users"></i> <span class="nav-label">Product Listing</span></a></li>
        </ul>
	</div>
</nav>