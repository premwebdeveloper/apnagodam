<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    // Custom login response function
    protected function sendLoginResponse(Request $request)
    {

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        # Get User role
        $user = Auth::user();

        $user_roles = DB::table('user_roles')->where('user_id', $user->id)->first();

        # User Role id
        $role_id = $user_roles->role_id;

        # If the logged in user is admin or government role
        if($role_id)
        {
            # empty otp for this user if successfully logged iN
            $user = DB::table('users')->where('id', $user->id)->update(['login_otp' => null]);
            return redirect(route('dashboard'));
        }
    }

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom function to redirect after login failed
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect('login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')]
            ]);
    }
}
