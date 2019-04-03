<?php

namespace App\Rules;

use Auth;
use Hash;
use Illuminate\Contracts\Validation\Rule;

final class PasscheckRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Hash::check($value, Auth::user()->getAuthPassword());
    }

    public function message(): string
    {
        return '原密碼輸入錯誤';
    }
}
