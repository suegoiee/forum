<?php

namespace App\Http\Controllers\Blogs;

use App\Models\Tag;
use App\Models\Thread;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        return view('blogs.overview', ['threads' => Thread::feedByTagPaginated($tag), 'activeTag' => $tag]);
    }
}
