<?php

namespace App\Helpers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTags
{
    /**
     * @return \App\Models\Tag[]
     */
    public function tags()
    {
        return $this->tagsRelation;
    }

    /**
     * @param \App\Models\Tag[]|int[] $tags
     */
    public function syncTags(array $tags)
    {
        $this->save();
        $this->tagsRelation()->sync($tags);
    }

    public function removeTags()
    {
        $this->tagsRelation()->detach();
    }

    public function tagsRelation(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'category_thread')->withTimestamps();
    }

    public function productRelation(): BelongsTo
    {
        return $this->BelongsTo(Product::class, 'product_id');
    }

    public function categoriesRelation(): BelongsTo
    {
        return $this->BelongsTo(Tag::class, 'category_id');
    }
}
