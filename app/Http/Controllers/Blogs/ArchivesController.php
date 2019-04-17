<?php

namespace App\Http\Controllers\Blogs;

use App\Models\Tag;
use App\Models\Reply;
use App\Models\Thread;
use App\Jobs\CreateThread;
use App\Jobs\DeleteThread;
use App\Jobs\UpdateThread;
use App\Policies\ThreadPolicy;
use App\Queries\SearchThreads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThreadRequest;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfUnconfirmed;

class ArchivesController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, RedirectIfUnconfirmed::class], ['except' => ['overview', 'show']]);
    }

    public function overview()
    {
        $search = request('search');
        $threads = $search ? SearchThreads::get($search) : Thread::feedPaginated();

        return view('blogs.overview', compact('threads', 'search'));
    }

    public function show(Thread $thread)
    {
        return view('blogs.archives.show', compact('thread'));
    }

    public function create()
    {
        return view('blogs.archives.create', ['tags' => Tag::all()]);
    }

    public function store(ThreadRequest $request)
    {
        $thread = $this->dispatchNow(CreateThread::fromRequest($request));

        $this->success('blogs.archives.created');

        return redirect()->route('archives', $thread->slug());
    }

    public function edit(Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        return view('blogs.archives.edit', ['thread' => $thread, 'tags' => Tag::all()]);
    }

    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $thread = $this->dispatchNow(UpdateThread::fromRequest($thread, $request));

        $this->success('blogs.archives.updated');

        return redirect()->route('archives', $thread->slug());
    }

    public function delete(Thread $thread)
    {
        $this->authorize(ThreadPolicy::DELETE, $thread);

        $this->dispatchNow(new DeleteThread($thread));

        $this->success('blogs.archives.deleted');

        return redirect()->route('blogs');
    }
}
