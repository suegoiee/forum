<?php

namespace App\Jobs;

use App\User;
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

    public function handle(Hasher $hasher)
    {
        $data = [
            'email' => $this->user->email
        ];
        $http = new \GuzzleHttp\Client;
        $response = $http->request('post',env("UA_CONFIRM_USER_API_URL"),[
                'headers'=>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ',
                ],
                'form_params' => $data,
            ]);
    }
}
