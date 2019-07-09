<?php

namespace App\Jobs;

use App\User;
use Ramsey\Uuid\Uuid;
use App\Models\Tag;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Http\Requests\CreateCategoryProductRequest;

final class CreateCategoryProduct
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \App\Models\CategoryProduct
     */
    private $categoryproduct;

    public function __construct(array $category_id, array $product_id)
    {
        $this->category_id = $category_id;
        $this->product_id = $product_id;
    }

    public static function fromRequest(CreateCategoryProductRequest $request): self
    {
        return new static(
            $request->category_id(),
            $request->product_id()
        );
    }

    public function handle(): CategoryProduct
    {
        $category_ids = $this->category_id;
        $product_ids = $this->product_id;
        for($i = 0; $i < count($category_ids); $i++){
            $categoryproduct[$i] = CategoryProduct::firstOrCreate([
                'category_id' => $category_ids[$i],
                'product_id' => $product_ids[$i],
            ]);
            $categoryproduct[$i]->save();
        }

        return $categoryproduct[0];
    }
}
