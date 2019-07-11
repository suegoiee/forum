<?php

namespace App\Http\Controllers\Forum;

use App\Models\Category;
use App\Models\Thread;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show(Category $tag)
    {
        return view('forum.overview', ['threads' => Thread::feedByTagPaginated($tag), 'activeTag' => $tag]);
    }
}
