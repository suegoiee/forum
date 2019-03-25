<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use App\Jobs\RegisterUserVerified;
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController;

class RegisterController extends APIController
{
    
    public function __construct()
    {
        
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data): ValidatorContract
    {
        return Validator::make($data, app(RegisterRequest::class)->rules());
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function register(Request $request)
    {
        $data = $request->all();
        $user = $this->dispatchNow(new RegisterUserVerified($data));
        return $user;
    }
}
