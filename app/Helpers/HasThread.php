<?php

namespace App\Helpers;

use App\Models\Reply;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Thread;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasThread
{

    /**
     * @return \App\Models\Thread[]
     */
    public function threads()
    {
        return $this->threadsRelation();
    }

    public function deleteCategory()
    {
        $this->masterRelation()->delete();
        $this->threadsRelation()->delete();
    }

    public function threadsRelation(): MorphToMany
    {
        return $this->MorphToMany(Thread::class, 'category', 'category_threads', 'category_id', 'category_thread_id')->withTimestamps();
    }

    public function masterRelation(): hasMany
    {
        return $this->hasMany(Permission::class, 'category_id');
    }

    public function repliesRelation(): MorphMany
    {
        return $this->MorphMany(Reply::class, 'threads', 'replyable_type', 'replyable_id');
    }
    
}
