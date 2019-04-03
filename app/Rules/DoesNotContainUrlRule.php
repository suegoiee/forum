<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

final class DoesNotContainUrlRule implements Rule
{
    use ValidatesAttributes;

    public function passes($attribute, $value): bool
    {
        return ! collect(explode(' ', $value))->contains(function ($word) {
            return $this->validateRequired('word', $word) && $this->validateUrl('word', $word);
        });
    }

    public function message(): string
    {
        return '此 :attribute 不能包含連結!';
    }
}
