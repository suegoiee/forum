<?php

namespace App\Http\Controllers\Auth;

use Hash;
use Storage;
use Socialite;
use App\User;
use App\Models\SocialiteDB;
use Shouwda\Google\Google;
use App\Traits\OauthToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\User as SocialiteUser;

class GoogleController extends Controller
{
	use OauthToken;
    protected $google;
    public function __construct()
    {
        $this->google = new Google();
    }
    public function login(Request $request)
    {
        try {
            $socialiteUser = $this->getSocialiteUser();
        } catch (InvalidStateException $exception) {
            $this->error('errors.github_invalid_state');
            return redirect()->route('login');
        }
        dd($socialiteUser = $this->getSocialiteUser());
        $log = ['time'=>date('Y-m-d H:i:s'), 'email'=>$request->input('email',''), 'password'=>$request->input('password',''), 'encoding_password'=>bcrypt($request->input('password','')), 'nickname'=>$request->input('nickname','')];
        Storage::append('login.log', json_encode($log));
    	return $this->loginHandler($request);
    }
    public function mobileLogin(Request $request)
    {
        return $this->loginHandler($request, true);
    }
    protected function loginHandler($request, $mobile=false){
        $id_token = $request->input('id_token');
        $access_token = $request->input('access_token');
        $google_user = $this->google->getUser($id_token, $access_token);
        if(!$google_user){
            return $this->validateErrorResponse([trans('auth.google_error')]);
        }
        $socialite = Socialite::where('provider', 'google')->where('provider_id', $google_user['id'])->first();

        $socialite_data = [
            'provider'=>'google',
            'provider_id'=>$google_user['id'],
            'name'=>$google_user['name'],
            'email'=>$google_user['email'],
            'access_token'=>$access_token,
        ];

        $request->request->add(['email'=>$socialite_data['email'],
            'provider_id'=>$socialite_data['provider_id'],
            'nickname'=>$socialite_data['name']]);

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $this->validateErrorResponse($validator->errors()->all());
        }

        if($socialite){
            $user = $socialite->user;
            $socialite->update([
                'email'=>$socialite_data['email'],
                'name'=>$socialite_data['name'],
                'access_token'=>$socialite_data['access_token']
            ]);
            if(!$user->mail_verified_at){
                User::where('id',$user->id)->update(['mail_verified_at'=>date('Y-m-d H:i:s'),'confirmed'=>1]);
            }
            $user->touch();
            return $this->logined($request, $user, $mobile);
        }else{
            
            $user = User::where('email',$socialite_data['email'])->first();
            if(!$user){
                $user = $this->create($request->all());
                $user->socialite()->create($socialite_data);
                return $this->registered($request, $user, $mobile);
            }
            if(!$user->mail_verified_at){
                User::where('id',$user->id)->update(['mail_verified_at'=>date('Y-m-d H:i:s'),'confirmed'=>1]);
            }
            $user->socialite()->create($socialite_data);
            return $this->logined($request, $user, $mobile);
        }
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['nickname'],
            'username'=>$data['email'],
            'confirmed'=>1,
            'bio'=>'',
            'password' => bcrypt($data['provider_id']),
            'is_socialite' => 2,
            'confirmation_code'=>'',
            'phone' => isset($data['phone']) ? $data['phone']:NULL,
            'mail_verified_at'=>date('Y-m-d H:i:s'),
            'set_password' => 0,
        ]);
    }

    protected function registered(Request $request, $user, $mobile)
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
    }
    protected function logined(Request $request,$user, $mobile)
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
        Auth::login($user);
        return redirect()->route('forum');
        //return $this->successResponse($token);
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
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id_token' => 'required|string',
            'access_token' => 'required|string',
        ]);
    }

    private function getSocialiteUser(): SocialiteUser
    {
        return Socialite::driver('google')->user();
    }
}
