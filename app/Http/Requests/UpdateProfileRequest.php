<?php

namespace App\Http\Requests;

use Auth;

class UpdateProfileRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
            'username' => 'required|max:255'.Auth::id(),
            'address',
            'phone',
            'bio' => 'max:160',
        ];
    }

    public function bio(): string
    {
        return (string) $this->get('bio', '');
    }

    public function address(): string
    {
        return (string) $this->get('address');
    }

    public function phone(): string
    {
        return (string) $this->get('phone');
    }

    public function name(): string
    {
        return (string) $this->get('name');
    }

    public function email(): string
    {
        return (string) $this->get('email');
    }

    public function username(): string
    {
        return (string) $this->get('username');
    }
}
