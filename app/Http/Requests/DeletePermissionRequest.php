<?php

namespace App\Http\Requests;

class DeletePermissionRequest extends Request
{
    public function rules()
    {
        return [
            'id',
        ];
    }

    public function id(): int
    {
        return (int) $this->get('id');
    }
}
