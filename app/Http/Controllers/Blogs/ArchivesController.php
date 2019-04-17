<?php

namespace App\Http\Controllers\Blogs;

use App\Models\Tag;
use App\Models\Reply;
use App\Models\Archive;
use App\Jobs\CreateArchive;
use App\Jobs\DeleteArchive;
use App\Jobs\UpdateArchive;
use App\Policies\ArchivePolicy;
use App\Queries\SearchArchives;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArchiveRequest;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfUnconfirmed;

class ArchivesController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, RedirectIfUnconfirmed::class], ['except' => ['overview', 'show']]);
    }

    public function overview(Request $request)
    {
        $search = request('search');
        $archives = $search ? SearchArchives::get($search) : Archive::feedPaginated();
        $count = $search ? SearchArchives::count($search) : Archive::count();
        $user = $request->user();
        return view('blogs.overview', compact('archives', 'search', 'count'));
    }

    public function show(Archive $archive)
    {
        return view('blogs.archives.show', compact('archive'));
    }

    public function create()
    {
        return view('blogs.archives.create', ['tags' => Tag::all()]);
    }

    public function store(ArchiveRequest $request)
    {
        $thread = $this->dispatchNow(CreateThread::fromRequest($request));

        $this->success('blogs.archives.created');

        return redirect()->route('archives', $thread->slug());
    }

    public function edit(Archive $archive)
    {
        $this->authorize(ArchivePolicy::UPDATE, $archive);

        return view('blogs.archives.edit', ['archive' => $archive, 'tags' => Tag::all()]);
    }

    public function update(ArchiveRequest $request, Archive $archive)
    {
        $this->authorize(ArchivePolicy::UPDATE, $archive);

        $archive = $this->dispatchNow(UpdateThread::fromRequest($archive, $request));

        $this->success('blogs.archives.updated');

        return redirect()->route('archives', $archive->slug());
    }

    public function delete(Archive $archive)
    {
        $this->authorize(ThreadPolicy::DELETE, $archive);

        $this->dispatchNow(new DeleteThread($archive));

        $this->success('blogs.archives.deleted');

        return redirect()->route('blogs');
    }
}
