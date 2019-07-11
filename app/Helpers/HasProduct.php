<?php

namespace App\Helpers;

use App\Models\CategoryProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasProduct
{
    /**
     * @return \App\Models\Product[]
     */
    public function Products()
    {
        return $this->productsUserRelation;
    }

    public function removeProduct()
    {
        $this->productRelation()->detach();
    }

    public function productRelation(): BelongsTo
    {
        return $this->BelongsTo(Product::class, 'user_id');
    }

    /**
     * @return \App\Models\Category[]
     */
    public function Category()
    {
        return $this->categoryRelation;
    }

    /**
     * @return \App\Models\Category[]
     */
    public function categoryRelation(): BelongsTo
    {
        return $this->BelongsTo(Category::class, 'id');
    }

    public function categoryProductRelation(): hasMany
    {
        return $this->hasMany(CategoryProduct::class, 'category_id');
    }

    public function productsUserRelation(): hasMany
    {
        return $this->hasMany(ProductUser::class);
    }

    public function productsRelation(): hasMany
    {
        return $this->hasMany(Product::class);
    }

}
