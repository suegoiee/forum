<?php

namespace App\Http\Controllers\Blogs;

use App\Models\Category;
use App\Models\Archive;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show(Category $tag)
    {
        return view('blogs.overview', ['archives' => Archive::feedByTagPaginated($tag), 'activeTag' => $tag]);
    }
}
