<?php

namespace App\Jobs;

use App\User;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class RegisterUAUserConfirmed
{
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $data = [
            'email' => $this->user->email,
            'nickname' => strtolower($this->user->username),
            'password'=> $this->user->getAuthPassword(),
            'is_socialite'=>$this->user->is_socialite,
            'mail_verified_at'=>$this->user->confirmed ? date('Y-m-d H:i:s') : NULL
        ];
        dd($data);
        $http = new \GuzzleHttp\Client;
        $response = $http->request('post',env("UA_REGISTER_API_URL"),[
                'headers'=>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ',
                ],
                'form_params' => $data,
            ]);
    }
}
