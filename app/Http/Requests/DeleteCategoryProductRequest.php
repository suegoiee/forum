<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\CategoryProduct;

class DeleteCategoryProductRequest extends Request
{
    public function rules()
    {
        return [
            'id' => 'int|required',
        ];
    }

    public function id(): int
    {
        return $this->get('id');
    }
}
