<?php

namespace App\Jobs;

use App\User;
use App\Models\Profile;
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

    public function __construct(string $name, string $email, string $username, string $password)
    {
        $this->name = $username;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public static function fromRequest(RegisterRequest $request): self
    {
        return new static(
            $request->name(),
            $request->emailAddress(),
            $request->username(),
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
            //'password'=>$hasher->make($this->password),
            'confirmation_code' => str_random(60),
            'password'=>bcrypt($this->password),
            'type' => User::DEFAULT,
            'remember_token' => '',
        ]);
        $user->save();
        $profile = new Profile([
            'user_id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->name,
        ]);
        $profile->save();
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
