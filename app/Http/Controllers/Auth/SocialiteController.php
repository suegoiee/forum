<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Social\GithubUser;
use App\Jobs\UpdateProfile;
use App\Models\SocialiteDB;
use Illuminate\Http\Request;
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
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     */
    public function handleProviderCallback(Request $request)
    {
        try {
            $socialiteUser = Socialite::driver('google')->stateless()->user();
        } catch (InvalidStateException $exception) {
            $this->error('errors.github_invalid_state');
            return redirect()->route('login');
        }

        try {
            $user = User::findByEmailAddress($socialiteUser->getEmail());
        } catch (ModelNotFoundException $exception) {
            return $this->userNotFound($socialiteUser);
        }

        return $this->userFound($user, $socialiteUser);
    }

    private function getSocialiteUser(): SocialiteUser
    {
        return Socialite::driver('google')->user();
    }

    private function userFound(User $user, SocialiteUser $socialiteUser): RedirectResponse
    {
        $socialite = SocialiteDB::where('provider', 'google')->where('provider_id', $socialiteUser['id'])->first();

        $socialite_data = [
            'provider'=>'google',
            'provider_id'=>$socialiteUser['id'],
            'name'=>$socialiteUser['name'],
            'email'=>$socialiteUser['email'],
        ];
        $user = User::where('email',$socialite_data['email'])->first();
        if($socialite){
            $socialite->update([
                'email'=>$socialite_data['email'],
                'name'=>$socialite_data['name']
            ]);
        }else{
            $user->socialite()->create($socialite_data);
        }
        if(!$user->mail_verified_at){
            User::where('id',$user->id)->update(['mail_verified_at'=>date('Y-m-d H:i:s'),'confirmed'=>1]);
            $user->touch();
        }
        Auth::login($user, true);
        $this->success('歡迎來到優分析');
        return redirect()->route('forum');
    }

    private function userNotFound(SocialiteUser $socialiteUser): RedirectResponse
    {
        $socialite = SocialiteDB::where('provider', 'google')->where('provider_id', $socialiteUser['id'])->first();

        $socialite_data = [
            'provider'=>'google',
            'provider_id'=>$socialiteUser['id'],
            'name'=>$socialiteUser['name'],
            'email'=>$socialiteUser['email'],
        ];

        $user_data = [
            'email'=>$socialiteUser['email'],
            'is_socialite'=>2,
            'version'=>2,
            'mail_verified_at'=>date("Y-m-d H:i:s"),
            'subscription'=>1,
            'name'=>$socialiteUser['name'],
            'username'=>$socialiteUser['name'],
            'confirmed'=>1,
            'type'=>1,
            'password'=>bcrypt($socialiteUser['id'])
        ];

        $user = User::create($user_data);

        if($socialite){
            $socialite->update([
                'email'=>$socialite_data['email'],
                'name'=>$socialite_data['name']
            ]);
        }else{
            $user->socialite()->create($socialite_data);
        }
        Auth::login($user, true);
        $this->success('歡迎來到優分析');
        return redirect()->route('forum');
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
