<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        # Get user id
        $currentuserid = Auth::user()->id;

        # Get User role
        $user = DB::table('user_roles')->where('user_id', $currentuserid)->first();

        # User Role id
        $role_id = $user->role_id;

        if($role_id == 1)
        {
            return $next($request);
        }

        return redirect(route('/'));
    }
}
