<?php

namespace App\Http\Controllers\Auth;

use Hash;
use App\User;
use App\Jobs\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Jobs\RegisterUAUserConfirmed;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FacebookController extends Controller
{

    use AuthenticatesUsers;
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
    public function login(Request $request)
    {
        $user = $this->create($request->all());
        dd($user);
        $this->validateLogin($request);
        $user = User::where('is_socialite',1)->where('email', $request->input('email'))->first();
        if( $user ){
            if(Hash::check($request->input('password'), $user->getAuthPassword())){
                $user->touch();
                if($this->attemptLogin($request)){
                    return $this->sendLoginResponse($request);
                }
            }
        }else{
            $n_user = User::whereIn('is_socialite',[0,2])->where('email',$request->input('email'))->first();
            if($n_user ){
                $this->error('auth.facebook.email_exists');
                return back();
            }
            $user = $this->create($request->all());
            $this->registered($request,$user);
            if($this->attemptLogin($request)){
                return $this->sendLoginResponse($request);
            }
        }
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function create(array $data)
    {
        $users = $this->dispatchNow(RegisterUser::fromRequest(app(RegisterRequest::class)));
        dd($users);
        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name'=> $data['username'],
            'username'=> $data['email'],
            'is_socialite' => 1,
            'confirmed'=>1,
        ]);
        return $user;
    }
    protected function registered(Request $request,$user)
    {
        return $this->dispatchNow(new RegisterUAUserConfirmed($user));
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
