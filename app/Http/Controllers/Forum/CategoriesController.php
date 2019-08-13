<?php

namespace App\Http\Controllers\Forum;

use App\Models\Category;
use App\Models\Thread;
use App\Models\CategoryProduct;
use App\Policies\UserPolicy;
use App\Policies\ThreadPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    public function show(Category $tag)
    {
        $tags = Category::with('categoryProductRelation')->orderBy('id')->get();
        $threads = Thread::feedByTagPaginated($tag);
        $activeTag = $tag;
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
        return view('forum.overview', compact('threads', 'tags', 'activeTag'));
    }
}
