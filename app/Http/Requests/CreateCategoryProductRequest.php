<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Tag;

class CreateCategoryProductRequest extends Request
{
    public function rules()
    {
        return [
            'category_id' => 'array|required',
            'product_id' => 'array|required',
        ];
    }

    public function category_id(): array
    {
        return $this->get('category_id');
    }

    public function product_id(): array
    {
        return $this->get('product_id');
    }
}
