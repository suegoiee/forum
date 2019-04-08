<?php

namespace App\Jobs;

use App\User;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Hashing\Hasher;

final class RegisterUser
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

    public function handle(Hasher $hasher): User
    {
        $this->assertEmailAddressIsUnique($this->email);
        //$this->assertUsernameIsUnique($this->username);

        $user = new User([
            'name' => $this->name,
            'email' => $this->email,
            'username' => strtolower($this->username),
            'github_id' => $this->githubId,
            'github_username' => $this->githubUsername,
            'confirmation_code' => str_random(60),
            //'password'=>$hasher->make($this->password),
            'password'=>bcrypt($this->password),
            'type' => User::DEFAULT,
            'remember_token' => '',
        ]);
        $user->save();

        return $user;
    }

    private function assertEmailAddressIsUnique(string $emailAddress)
    {
        try {
            User::findByEmailAddress($emailAddress);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw CannotCreateUser::duplicateEmailAddress($emailAddress);
    }
}
