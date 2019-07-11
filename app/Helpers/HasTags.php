<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTags
{
    /**
     * @return \App\Models\Category[]
     */
    public function tags()
    {
        return $this->tagsRelation;
    }

    /**
     * @param \App\Models\Category[]|int[] $tags
     */
    public function syncTags(array $tags)
    {
        $this->save();
        $this->tagsRelation()->attach($tags, ['category_type' => 'Categories']);
        //$this->tagsRelation()->sync($tags);
    }

    public function removeTags()
    {
        $this->tagsRelation()->detach();
    }

    public function tagsRelation(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'category_thread')->withTimestamps();
    }

    public function productRelation(): BelongsTo
    {
        return $this->BelongsTo(Product::class, 'product_id');
    }

    public function categoriesRelation(): BelongsTo
    {
        return $this->BelongsTo(Category::class, 'category_id');
    }
}
