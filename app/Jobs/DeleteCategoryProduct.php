<?php

namespace App\Jobs;

use DB;
use App\Models\CategoryProduct;
use App\Http\Requests\DeleteCategoryProductRequest;

final class DeleteCategoryProduct
{
    private $categoryProduct;
    private $DeleteId;

    public function __construct(CategoryProduct $categoryProduct, array $DeleteId = [])
    {
        $this->categoryProduct = $categoryProduct;
        $this->DeleteId = array_only($DeleteId, ['id']);
    }

    public static function fromRequest(CategoryProduct $categoryProduct, DeleteCategoryProductRequest $request): self
    {
        return new static($categoryProduct, [
            'id' => $request->id()
        ]);
    }

    public function handle()
    {
        DB::table('category_product')->where('id', '=', $this->DeleteId)->delete();
    }
}
