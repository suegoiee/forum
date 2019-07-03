<?php

namespace App\Helpers;

use App\Models\Tag;
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
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function categoriesRelation(): BelongsTo
    {
        return $this->BelongsTo(Tag::class, 'category_id');
    }
}
