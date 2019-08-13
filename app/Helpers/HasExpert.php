<?php

namespace App\Helpers;

use App\Models\Expert;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasExpert
{
    public function expertRelation(): MorphToMany
    {
        return $this->morphToMany(Expert::class, 'expertable', 'expertables');
    }
}
