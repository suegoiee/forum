<?php

namespace App\Http\Requests;

use Auth;

class BanReplyRequest extends Request
{
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    public function id(): int
    {
        return (int) $this->get('id');
    }
}
