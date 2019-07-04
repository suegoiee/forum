<?php

namespace App\Helpers;

use App\Models\CategoryProduct;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasProduct
{
    /**
     * @return \App\Models\CategoryProduct[]
     */
    public function Product()
    {
        return $this->productRelation;
    }

    public function removeProduct()
    {
        $this->productRelation()->detach();
    }

    public function productRelation(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    /**
     * @return \App\Models\Tag[]
     */
    public function Category()
    {
        return $this->categoryRelation;
    }

    /**
     * @return \App\Models\Tag[]
     */
    public function categoryRelation(): BelongsTo
    {
        return $this->BelongsTo(Tag::class, 'id');
    }

}
