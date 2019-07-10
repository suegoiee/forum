<?php

namespace App\Jobs;

use App\Models\Tag;

final class DeleteCategory
{
    /**
     * @var \App\Models\Tag
     */
    private $category;

    public function __construct(Tag $category)
    {
        $this->category = $category;
    }

    public function handle()
    {
        $this->category->delete();
    }
}
