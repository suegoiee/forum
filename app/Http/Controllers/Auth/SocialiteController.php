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
            //$socialiteUser = Socialite::driver('google')->user();
            $socialiteUser = Socialite::driver('google')->stateless()->user();
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
        /*$this->dispatchNow(new RegisterGoogleUser($socialiteUser->getName(), $socialiteUser->getEmail(), $socialiteUser->getName(), '', '', $socialiteUser->getId(), 2, 1));*/
        
        $socialite = SocialiteDB::where('provider', 'google')->where('provider_id', $socialiteUser['id'])->first();

        $socialite_data = [
            'provider'=>'google',
            'provider_id'=>$socialiteUser['id'],
            'name'=>$socialiteUser['name'],
            'email'=>$socialiteUser['email'],
        ];

        if($socialite){
            $user = $socialite->user;
            $socialite->update([
                'email'=>$socialite_data['email'],
                'name'=>$socialite_data['name']
            ]);
            if(!$user->mail_verified_at){
                User::where('id',$user->id)->update(['mail_verified_at'=>date('Y-m-d H:i:s'),'confirmed'=>1]);
            }
            $user->touch();
            Auth::login($user);
            $this->success('歡迎來到優分析');
            return redirect()->route('forum');
            //return $this->logined($request, $user, $mobile);
        }else{
            
            $user = User::where('email',$socialite_data['email'])->first();
            if(!$user){
                $user = $this->create($request->all());
                $user->socialite()->create($socialite_data);
                Auth::login($user);
                $this->success('歡迎來到優分析');
                return redirect()->route('forum');
                //return $this->registered($request, $user);
            }
            if(!$user->mail_verified_at){
                User::where('id',$user->id)->update(['mail_verified_at'=>date('Y-m-d H:i:s'),'confirmed'=>1]);
            }
            $user->socialite()->create($socialite_data);
            Auth::login($user);
            $this->success('歡迎來到優分析');
            return redirect()->route('forum');
            //return $this->logined($request, $user, $mobile);
        }

        /*$user = User::findByEmailAddress($socialiteUser->getEmail());
        $this->registered($user);
        Auth::login($user);
        $this->success('歡迎來到優分析');
        return redirect()->route('forum');*/
    }

    /*protected function registered(Request $request, $user)
    {
        $this->createProfile($request, $user);
        $adminToken = $this->clientCredentialsGrantToken($request);
        event(new UserRegistered($user, $adminToken, $request->input('password'), false));
        $client = $mobile ? $this->getMobilePasswordGrantClient() : $this->getPasswordGrantClient();
        $user_token = $user->createToken($client->name);
        $token = [
            'token_type'=>'Bearer',
            'expires_in'=>$user_token->token->expires_at->toDateTimeString(),
            'access_token'=>$user_token->accessToken,
            'refresh_token'=>'',
            'verified'=>$user->mail_verified_at ? 1 : 0,
            'is_socialite'=>$user->is_socialite,
            'set_password'=> $user->set_password
        ];
        return $this->successResponse($token);
    }*/
    /*protected function logined(Request $request,$user, $mobile)
    {
        $client = $mobile ? $this->getMobilePasswordGrantClient() : $this->getPasswordGrantClient();
        $user_token = $user->createToken($client->name);
        $token = [
            'token_type'=>'Bearer',
            'expires_in'=>$user_token->token->expires_at->toDateTimeString(),
            'access_token'=>$user_token->accessToken,
            'refresh_token'=>'',
            'verified'=>$user->mail_verified_at ? 1 : 0,
            'is_socialite'=>$user->is_socialite,
            'set_password'=> $user->is_socialite !=0 && $user->version == 1 ? 0 : $user->set_password
        ];
        $this->updateProfile($request,$user);
        return $this->successResponse($token);
    }

    protected function createProfile(Request $request,$user){
        $store_data = $request->only(['nickname','name','sex','address','birthday']);
        $profile = $user->profile()->create($store_data);
        return $profile;
    }
    
    protected function updateProfile(Request $request,$user){
    	$profile = $request->only(['nickname','name','sex','address','birthday']);
        $user->profile()->update($profile);
        return $profile;
    }*/
}
