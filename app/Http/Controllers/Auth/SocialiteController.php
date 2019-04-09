<?php

namespace App\Http\Controllers\Auth;
use App\Jobs\RegisterGoogleUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return 301 
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $user = $this->dispatchNow(RegisterGoogleUser::fromRequest(app(RegisterRequest::class)));
        dd($user);
    }
}
