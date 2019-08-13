<?php

namespace App\Helpers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTag
{
    public function tagRelation(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables');
    }
}
