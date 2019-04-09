<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Jobs\RegisterUser;
use App\Jobs\RegisterUAUser;
use App\Jobs\RegisterGoogleUser;
use App\Jobs\SendEmailConfirmation;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
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
        /*$user = Socialite::driver('google')->user();
        dd($user);
        $user = $this->dispatchNow(RegisterGoogleUser::fromRequest(app(RegisterRequest::class)));*/
        try {
            $socialiteUser = $this->getSocialiteUser();
        } catch (InvalidStateException $exception) {
            $this->error('errors.github_invalid_state');
            return redirect()->route('login');
        }

        try {
            $user = User::findByEmailAddress($socialiteUser->emailAddress());
        } catch (ModelNotFoundException $exception) {
            return $this->userNotFound(new GithubUser($socialiteUser->getRaw()));
        }

        return $this->userFound($user, $socialiteUser);
    }

    private function getSocialiteUser(): SocialiteUser
    {
        return Socialite::driver('google')->user();
    }

    private function userFound(User $user, SocialiteUser $socialiteUser): RedirectResponse
    {
        $this->dispatchNow(new UpdateProfile($user, ['github_username' => $socialiteUser->getNickname()]));

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    private function userNotFound(GithubUser $user): RedirectResponse
    {
        if ($user->isTooYoung()) {
            $this->error('errors.github_account_too_young');

            return redirect()->home();
        }

        return $this->redirectUserToRegistrationPage($user);
    }

    private function redirectUserToRegistrationPage(GithubUser $user): RedirectResponse
    {
        session(['githubData' => $user->toArray()]);

        return redirect()->route('register');
    }
}