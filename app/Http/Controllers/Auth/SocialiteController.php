<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Social\GithubUser;
use App\Jobs\UpdateProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SocialiteController extends Controller
{
    use RegistersUsers;
    /**
     * Redirect the user to the GitHub authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     */
    public function handleProviderCallback()
    {
        try {
            $socialiteUser = $this->getSocialiteUser();
        } catch (InvalidStateException $exception) {
            $this->error('errors.github_invalid_state');
            return redirect()->route('login');
        }

        try {
            $user = User::findByEmailAddress($socialiteUser->getEmail());
        } catch (ModelNotFoundException $exception) {
            //return $this->userNotFound($socialiteUser);
            $this->error($socialiteUser->getEmail());
            return redirect()->route('login');
        }

        return $this->userFound($user, $socialiteUser);
    }

    private function getSocialiteUser(): SocialiteUser
    {
        return Socialite::driver('google')->user();
    }

    private function userFound(User $user, SocialiteUser $socialiteUser): RedirectResponse
    {
        Auth::login($user);
        return redirect()->route('forum');
    }

    private function userNotFound(SocialiteUser $socialiteUser): RedirectResponse
    {
        return $this->redirectUserToRegistrationPage($socialiteUser);
    }

    private function redirectUserToRegistrationPage(array $data): User
    {
        /*session(['githubData' => $user->toArray()]);
        return redirect()->route('register.post', []);*/
        $registerRequest = app(RegisterRequest::class);
        $user = $this->dispatchNow(RegisterUser::fromRequest(app(RegisterRequest::class)));
        return $user;
    }
}
