<?php

namespace App\Http\Requests;

use App\User;

class PermissionRequest extends Request
{
    public function rules()
    {
        return [
            'user_id' => 'array|required',
            'category_id' => 'array|required',
        ];
    }

    public function new_master(): User
    {
        return $this->user();
    }

    public function user_id(): array
    {
        return $this->get('user_id');
    }

    public function category_id(): array
    {
        return $this->get('category_id');
    }
}
