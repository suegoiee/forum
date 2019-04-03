<?php

namespace App\Http\Controllers\Auth;

use Hash;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/forum';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(RedirectIfAuthenticated::class, ['except' => 'logout']);
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();
        if( $user ){
            if(Hash::check($request->input('password'), $user->getAuthPassword())){
                return $this->guard()->login($user, $request->filled('remember'));
            }
        }
        return false;
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
