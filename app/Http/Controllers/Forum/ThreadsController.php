<?php

namespace App\Http\Controllers\Forum;

use App\Models\Tag;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Permission;
use App\Jobs\CreateThread;
use App\Jobs\DeleteThread;
use App\Jobs\UpdateThread;
use App\Jobs\BanThread;
use Illuminate\Http\Request;
use App\Policies\ThreadPolicy;
use App\Policies\UserPolicy;
use App\Queries\SearchThreads;
use App\Jobs\MarkThreadSolution;
use App\Jobs\UnmarkThreadSolution;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThreadRequest;
use App\Http\Requests\BanThreadRequest;
use App\Jobs\SubscribeToSubscriptionAble;
use Illuminate\Auth\Middleware\Authenticate;
use App\Jobs\UnsubscribeFromSubscriptionAble;
use App\Http\Middleware\RedirectIfUnconfirmed;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, RedirectIfUnconfirmed::class], ['except' => ['overview', 'show']]);
    }

    public function overview()
    {
        $search = request('search');
        $threads = $search ? SearchThreads::get($search) : Thread::feedPaginated();
        return view('forum.overview', compact('threads', 'search'));
    }

    public function show(Thread $thread)
    {
        $author = $thread->author()->username();
        $title = $thread->subject();
        $description = $thread->body() ;
        $masters = Permission::with(['permissionRelation', 'categoriesRelation'])->get();
        return view('forum.threads.show', compact('thread','description','title','author', 'masters'));
    }

    public function create()
    {
        $product_id = array();
        $user_products = \Auth::user()->Products();
        $tags = Tag::with('categoryProductRelation')->get();
        foreach($user_products as $user_product){
            if(strtotime($user_product['deadline']) > time() || $user_product['deadline'] == null){
                array_push($product_id, $user_product['product_id']);
            }
        }
        foreach($tags as $key => $tag){
            $count = 0;
            foreach($tag['categoryProductRelation'] as $key2 => $category){
                if( in_array($category['product_id'], $product_id ) ){
                    break;
                }
                $count++;
                if( !in_array($category['product_id'], $product_id) && count($tag['categoryProductRelation']) == $count ){
                    unset($tags[$key]);
                }
            }
        }
        return view('forum.threads.create', compact('tags'));
    }

    public function store(ThreadRequest $request)
    {
        $thread = $this->dispatchNow(CreateThread::fromRequest($request));

        $this->success('forum.threads.created');

        return redirect()->route('thread', $thread->slug());
    }

    public function edit(Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        return view('forum.threads.edit', ['thread' => $thread, 'tags' => Tag::all()]);
    }

    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $thread = $this->dispatchNow(UpdateThread::fromRequest($thread, $request));

        $this->success('forum.threads.updated');

        return redirect()->route('thread', $thread->slug());
    }

    public function delete(Thread $thread)
    {
        $this->authorize(ThreadPolicy::DELETE, $thread);

        $this->dispatchNow(new DeleteThread($thread));

        $this->success('forum.threads.deleted');

        return redirect()->route('forum');
    }

    public function banThreads(Thread $thread, BanThreadRequest $request)
    {
        //$this->authorize(UserPolicy::ADMIN, App\User::class);

        $this->dispatchNow(BanThread::fromRequest($thread, $request));

        $this->success("已隱藏此文章");
        
        return back();
        //return redirect()->route('thread', $thread->slug());
    }

    public function markSolution(Thread $thread, Reply $reply)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $this->dispatchNow(new MarkThreadSolution($thread, $reply));

        return redirect()->route('thread', $thread->slug());
    }

    public function unmarkSolution(Thread $thread)
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);

        $this->dispatchNow(new UnmarkThreadSolution($thread));

        return redirect()->route('thread', $thread->slug());
    }

    public function subscribe(Request $request, Thread $thread)
    {
        $this->authorize(ThreadPolicy::SUBSCRIBE, $thread);

        $this->dispatchNow(new SubscribeToSubscriptionAble($request->user(), $thread));

        $this->success("開始追蹤此文章");

        return redirect()->route('thread', $thread->slug());
    }

    public function unsubscribe(Request $request, Thread $thread)
    {
        $this->authorize(ThreadPolicy::UNSUBSCRIBE, $thread);

        $this->dispatchNow(new UnsubscribeFromSubscriptionAble($request->user(), $thread));

        $this->success("已取消追蹤此文章");

        return redirect()->route('thread', $thread->slug());
    }
}
