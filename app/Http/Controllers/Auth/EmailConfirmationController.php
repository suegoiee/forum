<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Jobs\ConfirmUser;
use App\Jobs\ConfirmUAUser;
use App\Jobs\SendEmailConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Auth\Middleware\Authenticate;

class EmailConfirmationController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class, ['only' => 'send']);
    }

    public function send()
    {
        if (Auth::user()->isConfirmed()) {
            $this->error('auth.confirmation.already_confirmed');
        } else {
            $this->dispatch(new SendEmailConfirmation(Auth::user()));

            $this->success('auth.confirmation.sent', Auth::user()->emailAddress());
        }

        return redirect()->route('dashboard');
    }

    public function confirm(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();
        if(!$user){
            $this->error('auth.confirmation.not_exist');
        }
        $code = $request->input('code');
        if ($user->matchesConfirmationCode($code)) {
            $this->dispatchNow(new ConfirmUser($user));
            $this->dispatchNow(new ConfirmUAUser($user));
            $this->success('auth.confirmation.success');
        } else {
            $this->error('auth.confirmation.no_match');
        }

        return Auth::check() ? redirect()->route('forum') : redirect()->home();
    }
}
