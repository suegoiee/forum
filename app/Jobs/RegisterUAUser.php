<?php

namespace App\Jobs;

use App\User;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Hashing\Hasher;

final class RegisterUAUser
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $githubId;

    /**
     * @var string
     */
    private $githubUsername;

    /**
     * @var string
     */
    private $password;

    public function __construct(string $name, string $email, string $username, string $githubId, string $githubUsername, string $password)
    {
        $this->name = $username;
        $this->email = $email;
        $this->username = $username;
        $this->githubId = $githubId;
        $this->githubUsername = $githubUsername;
        $this->password = $password;
    }

    public static function fromRequest(RegisterRequest $request): self
    {
        return new static(
            $request->name(),
            $request->emailAddress(),
            $request->username(),
            $request->githubId(),
            $request->githubUsername(),
            $request->password()
        );
    }

    public function handle(Hasher $hasher)
    {
        $data = [
            'email' => $this->email,
            'nickname' => strtolower($this->username),
            'password'=>$hasher->make($this->password),
        ];
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
