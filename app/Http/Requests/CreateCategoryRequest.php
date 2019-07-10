<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Tag;

class CreateCategoryRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'array|required',
        ];
    }

    public function name(): array
    {
        return $this->get('name');
    }

}
