<?php

namespace App\Jobs;

use App\User;
use App\Exceptions\CannotCreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Hashing\Hasher;
final class RegisterUserVerified
{
    /**
     * @var Register
     */
    private $register;

    

    public function __construct($register)
    {
        $this->register = $register;
    }

    public function handle(Hasher $hasher): User
    {
        $this->assertEmailAddressIsUnique($this->register['email']);
        //$this->assertUsernameIsUnique($this->register['username']);
        $this->register['password'] = $hasher->make($this->register['password']);
        $user = new User($this->register);
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

    /*private function assertUsernameIsUnique(string $username)
    {
        try {
            User::findByUsername($username);
        } catch (ModelNotFoundException $exception) {
            return true;
        }

        throw CannotCreateUser::duplicateUsername($username);
    }*/
}
