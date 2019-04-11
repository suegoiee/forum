<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Social\GithubUser;
use App\Jobs\UpdateProfile;
use App\Jobs\RegisterGoogleUser;
use App\Jobs\RegisterUAUserConfirmed;
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
            return $this->userNotFound($socialiteUser);
            //return $this->userNotFound($socialiteUser->getEmail());
            //return redirect()->route('register.post')->withInput(['email' => $socialiteUser->getEmail()]);
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
        //(string $name, string $email, string $username, string $githubId, string $githubUsername, string $password)
        $UAForm = $this->dispatchNow(new RegisterGoogleUser($socialiteUser->getName(), $socialiteUser->getEmail(), $socialiteUser->getName(), '', '', $socialiteUser->getId(), 1, 1));
        //$user = User::findByEmailAddress($socialiteUser->getEmail());
        //Auth::login($user);
        /*$UAForm = User::create([
            'email' => $socialiteUser->getEmail(),
            'password' => bcrypt($socialiteUser->getId()),
            'name'=> $socialiteUser->getName(),
            'username'=> $socialiteUser->getEmail(),
            'is_socialite' => 1,
            'confirmed'=>1,
        ]);*/
        //$result = $this->registered($UAForm);
        dd($UAForm);
        $this->success('歡迎來到優分析');
        //return redirect()->route('forum');
        //return $this->redirectUserToRegistrationPage($socialiteUser);
    }

    protected function registered($user)
    {
        return $this->dispatchNow(new RegisterUAUserConfirmed($user));
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['attributes']['email'],
            'password' => bcrypt($data['attributes']['password']),
            'name'=> $data['attributes']['username'],
            'username'=> $data['attributes']['email'],
            'is_socialite' => 1,
            'confirmed'=>1,
        ]);
    }
}
