<?php

namespace App\Jobs;

use App\Models\Category;

final class DeleteCategory
{
    /**
     * @var \App\Models\Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function handle()
    {
        $this->category->delete();
    }
}
