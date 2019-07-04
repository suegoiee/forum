<?php

namespace App\Http\Requests;

use App\User;
use App\Rules\HttpImageRule;
use App\Rules\DoesNotContainUrlRule;

class ThreadRequest extends Request
{
    public function rules()
    {
        return [
            'subject' => ['required', 'max:60', new DoesNotContainUrlRule],
            'body' => ['required', new HttpImageRule],
            'tags' => 'array',
            'tags.*' => 'exists:categories,id',
        ];
    }

    public function author(): User
    {
        return $this->user();
    }

    public function subject(): string
    {
        return $this->get('subject');
    }

    public function body(): string
    {
        return $this->get('body');
    }

    public function tags(): array
    {
        return $this->get('tags', []);
    }
}
