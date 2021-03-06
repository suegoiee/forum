<?php

namespace App\Http\Controllers\Forum;

use App\User;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Permission;
use App\Models\CategoryProduct;
use App\Jobs\CreateThread;
use App\Jobs\DeleteThread;
use App\Jobs\UpdateThread;
use App\Jobs\BanThread;
use App\Jobs\TopThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Policies\ThreadPolicy;
use App\Policies\UserPolicy;
use App\Queries\SearchThreads;
use App\Jobs\MarkThreadSolution;
use App\Jobs\UnmarkThreadSolution;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThreadRequest;
use App\Http\Requests\BanThreadRequest;
use App\Http\Requests\TopThreadRequest;
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
        $tags = Category::with('categoryProductRelation')->orderBy('id')->get();
        $search = request('search');
        $threads = $search ? SearchThreads::get($search) : Thread::feedPaginated();
        if(\Auth::user()){
            foreach($threads as $key => $thread){
                if(!Gate::check(UserPolicy::MASTER, [User::class, $thread->tags()[0]->id])){
                    if(!Gate::check(ThreadPolicy::ISVIP, [$thread, CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get()]) ){
                        unset($threads[$key]);
                        foreach($tags as $key => $tag){
                            if($tag['id'] == $thread->tags()[0]->id){
                                $tag['hide'] = 1;
                                break;
                            }
                        }
                    }
                }
            }
        }
        else{
            foreach($tags as $key => $tag){
                foreach($tag['categoryProductRelation'] as $key2 => $category){
                    if( $category ){
                        $tags[$key]['hide'] = 1;
                    }
                }
            }
            foreach($threads as $key => $thread){
                if(!empty(CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get()[0])){
                    unset($threads[$key]);
                }
            }
        }
        return view('forum.overview', compact('threads', 'search', 'tags'));
    }

    public function show(Thread $thread)
    {
        if(\Auth::user()){
            if(!Gate::check(ThreadPolicy::ISVIP, [$thread, CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get()]) ){
                if(!Gate::check(UserPolicy::MASTER, [User::class, $thread->tags()[0]->id])){
                    $this->error("您沒有購買相關產品或是產品時效已過期");
                    return redirect()->route("home");
                }
            }
        }
        else{
            $test = CategoryProduct::where('category_id', '=', $thread->tags()[0]->id)->get();
            if(!$test->isEmpty()){
                $this->error("請先登入");
                return redirect()->route("home");
            }
        }
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
        $tags = Category::with('categoryProductRelation')->get();
        if(!\Auth::user()->isAdmin()){
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
                    if( !in_array($category['product_id'], $product_id) && count($tag['categoryProductRelation']) == $count && !\Auth::user()->isMasteredBy($tag['id'])){
                        unset($tags[$key]);
                    }
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

        return view('forum.threads.edit', ['thread' => $thread, 'tags' => Category::all()]);
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
        $this->dispatchNow(BanThread::fromRequest($thread, $request));

        $this->success("已隱藏此文章");
        
        return back();
    }

    public function topThreads(Thread $thread, TopThreadRequest $request)
    {
        $this->dispatchNow(TopThread::fromRequest($thread, $request));

        $this->success("已置頂此文章");
        
        return back();
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
