<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Hashing\Hasher;

final class ConfirmUAUser
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Hasher $hasher): User
    {
        $this->user->update(['mail_verified_at' => \Carbon\Carbon::now()]);

        return $this->user;

        /*$data = [
            'email' => $this->user->email
        ];
        if(env("UA_CONFIRM_USER_API_URL")!=''){
        $http = new \GuzzleHttp\Client;
        $response = $http->request('post',env("UA_CONFIRM_USER_API_URL"),[
                'headers'=>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ',
                ],
                'form_params' => $data,
            ]);
        }*/
    }
}
