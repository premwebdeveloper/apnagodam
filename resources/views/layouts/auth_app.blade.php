@include('includes.auth_head')

@include('includes.auth_admin_sidebar')

@include('includes.auth_header')

	@yield('content')

@include('includes.auth_footer')

@include('includes.auth_footer_scripts')