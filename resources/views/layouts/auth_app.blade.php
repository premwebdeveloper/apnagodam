<?php 
if(Auth::user())
{
	$user = Auth::user(); 
	$details = DB::table('user_details')->where('user_id', $user->id)->first();
	$role = DB::table('user_roles')->where('user_id', $user->id)->first();
	$role_name = DB::table('roles')->where('id', $role->role_id)->first();
}else{
	redirect('/');
}
?>
@include('includes.auth_head')

@include('includes.auth_admin_sidebar')

@include('includes.auth_header')

	@yield('content')

@include('includes.auth_footer')

@include('includes.auth_footer_scripts')