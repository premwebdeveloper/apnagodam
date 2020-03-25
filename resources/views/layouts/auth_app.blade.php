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
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
$temp = explode('@', $controllerAction);
?>

@include('includes.auth_head')

@if($temp[0] == 'LeadController' || $temp[0] == 'InventoryController' || $temp[0] == 'FinanceController' || $temp[0] == 'CaseGenController')
	@include('includes.auth_mis_sidebar')
@else
	@if($role->role_id == 1 || $role->role_id == 2 || $role->role_id == 4)
		@include('includes.auth_admin_sidebar')
	@endif
@endif



@include('includes.auth_header')
	@yield('content')
@include('includes.auth_footer')

@include('includes.auth_footer_scripts')