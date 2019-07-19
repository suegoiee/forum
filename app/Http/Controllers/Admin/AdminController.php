<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Archive;
use App\Models\Product;
use App\Models\Permission;
use App\Models\Subscription;
use App\Models\CategoryProduct;
use App\Jobs\UpdatePermission;
use App\Jobs\DeleteCategory;
use App\Jobs\CreateCategory;
use App\Jobs\DeletePermission;
use App\Jobs\DeleteCategoryProduct;
use App\Jobs\CreateCategoryProduct;
use App\Queries\SearchUsers;
use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAdmins;
use App\Http\Requests\DeletePermissionRequest;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateCategoryProductRequest;
use App\Http\Requests\DeleteCategoryProductRequest;
use App\Policies\PermissionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Schema;
use Illuminate\Auth\Middleware\Authenticate;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, VerifyAdmins::class]);
    }

    public function index()
    {
        $search = request('search');
        //$users = $search ? SearchUsers::get($search) : User::findAllPaginated();
        $users = User::all();
        $masters = Permission::with(['permissionRelation', 'categoriesRelation'])->get();
        $tags = Category::all();
        //$test = User::all();
        return view('admin.overview', compact('masters', 'search', 'tags', 'users'));
    }

    public function category()
    {
        $users = User::all();
        $masters = Permission::with(['permissionRelation', 'categoriesRelation'])->get();
        $tags = Category::with(['categoryProductRelation'])->get();
        $products = Product::all();
        $categoryproducts = CategoryProduct::with(['categoriesRelation', 'productRelation'])->get();
        return view('admin.category', compact('masters', 'tags', 'users', 'categoryproducts', 'products'));
    }
    
    public function newCategory(CreateCategoryRequest $request){

        $category = $this->dispatchNow(CreateCategory::fromRequest($request));

        return back();
    }
    
    public function newCategoryProduct(CreateCategoryProductRequest $request){

        $cp = $this->dispatchNow(CreateCategoryProduct::fromRequest($request));
        
        return back();
    }
    
    public function deleteCategoryProduct(CategoryProduct $category, DeleteCategoryProductRequest $request){

        $cp = $this->dispatchNow(DeleteCategoryProduct::fromRequest($category, $request));
        
        return back();
    }

    public function update(PermissionRequest $request)
    {
        $permission = $this->dispatchNow(UpdatePermission::fromRequest($request));
        //print_r($permission);
        return redirect()->route('admin');
    }

    public function delete(Permission $permission, DeletePermissionRequest $request)
    {
        $this->dispatchNow(DeletePermission::fromRequest($permission, $request));
        //print_r($permission);
        return redirect()->route('admin');
    }

    public function deleteCategory(Category $Category)
    {
        $this->dispatchNow(new DeleteCategory($Category));

        $this->success('forum.categories.deleted');

        return redirect()->back();
    }

    public function permission()
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);
        $search = request('search');
        //$users = $search ? SearchUsers::get($search) : User::findAllPaginated();
        $users = User::with('permissionRelation')->get();
        //$test = User::all();
        return view('admin.overview', compact('users', 'search', 'test'));
    }

    public function migrateData()
    {
        $homestead_threads = DB::connection('mysql_3')->table('threads')->get();
        $homestead_articles = DB::connection('mysql_3')->table('archives')->get();
        $homestead_categories = DB::connection('mysql_3')->table('tags')->get();
        $homestead_categorie_threads = DB::connection('mysql_3')->table('taggables')->get();
        $homestead_replies = DB::connection('mysql_3')->table('replies')->get();
        $homestead_subscriptions = DB::connection('mysql_3')->table('subscriptions')->get();
        DB::statement("SET SQL_SAFE_UPDATES = 0;");
        //DB::statement('UPDATE ua_pro.users AS x , ua_forum.users AS y SET x.name = y.name, x.username = y.username, x.confirmed = y.confirmed WHERE x.email = y.email');
        DB::statement('UPDATE ua_pro.users AS x , ua_forum.users AS y SET x.confirmation_code = y.confirmation_code WHERE x.email = y.email');
        /*Schema::disableForeignKeyConstraints();
        foreach($homestead_threads as $homestead_thread){
            Thread::firstOrCreate(
                [
                    'id' => $homestead_thread->id, 
                    'author_id' => $homestead_thread->author_id,
                    'subject' => $homestead_thread->subject,
                    'body' => $homestead_thread->body,
                    'slug' => $homestead_thread->slug,
                    'solution_reply_id' => 0,
                    'created_at' => $homestead_thread->created_at,
                    'updated_at' => $homestead_thread->updated_at
                ]
            );
        }
        foreach($homestead_articles as $homestead_article){
            Archive::firstOrCreate(
                [
                    'id' => $homestead_article->id, 
                    'author_id' => 5232,
                    'subject' => $homestead_article->subject,
                    'body' => $homestead_article->body,
                    'slug' => $homestead_article->slug,
                    'solution_reply_id' => $homestead_article->solution_reply_id,
                    'created_at' => $homestead_article->created_at,
                    'updated_at' => $homestead_article->updated_at
                ]
            );
        }
        foreach($homestead_categories as $homestead_category){
            Category::firstOrCreate(
                [
                    'id' => $homestead_category->id, 
                    'name' => $homestead_category->name,
                    'slug' => $homestead_category->slug
                ]
            );
        }
        foreach($homestead_categorie_threads as $homestead_categorie_thread){
            DB::table('category_threads')->insert(
                [
                    'id' => $homestead_categorie_thread->id, 
                    'category_thread_id' => $homestead_categorie_thread->taggable_id,
                    'category_thread_type' => $homestead_categorie_thread->taggable_type,
                    'created_at' => $homestead_categorie_thread->created_at,
                    'updated_at' => $homestead_categorie_thread->updated_at,
                    'category_id' => $homestead_categorie_thread->tag_id,
                    'category_type' => 'categories'
                ]
            );
        }
        foreach($homestead_replies as $homestead_reply){
            DB::table('replies')->insert(
                [
                    'id' => $homestead_reply->id, 
                    'body' => $homestead_reply->body,
                    'author_id' => $homestead_reply->author_id,
                    'replyable_id' => $homestead_reply->replyable_id,
                    'created_at' => $homestead_reply->created_at,
                    'updated_at' => $homestead_reply->updated_at,
                    'replyable_type' => $homestead_reply->replyable_type
                ]
            );
        }
        foreach($homestead_subscriptions as $homestead_subscription){
            DB::table('subscriptions')->insert(
                [
                    'uuid' => $homestead_subscription->uuid, 
                    'user_id' => $homestead_subscription->user_id,
                    'subscriptionable_id' => $homestead_subscription->subscriptionable_id,
                    'subscriptionable_type' => $homestead_subscription->subscriptionable_type,
                    'created_at' => $homestead_subscription->created_at,
                    'updated_at' => $homestead_subscription->updated_at
                ]
            );
        }*/
        DB::statement("SET SQL_SAFE_UPDATES = 1;");
        //Schema::enableForeignKeyConstraints();
    }

    public function changeAuthorIdToUaVersion()
        {
        set_time_limit(0);
        $ua_thread_authors = Thread::select('author_id')->distinct()->get();
        $ua_archive_authors = Archive::select('author_id')->distinct()->get();
        $ua_replies_authors = Reply::select('author_id')->distinct()->get();
        $ua_subscription_authors = Subscription::select('user_id')->distinct()->get();
        $homestead_thread_email = DB::connection('mysql_3')->table('users')->select('email')->wherein('id', $ua_thread_authors)->get();
        $homestead_archive_email = DB::connection('mysql_3')->table('users')->select('email')->wherein('id', $ua_archive_authors)->get();
        $homestead_replies_email = DB::connection('mysql_3')->table('users')->select('email')->wherein('id', $ua_replies_authors)->get();
        $homestead_subscription_email = DB::connection('mysql_3')->table('users')->select('email')->wherein('id', $ua_subscription_authors)->get();
        $arrayid1 = array();
        $arrayid2 = array();
        $arrayid3 = array();
        $arrayid4 = array();
        $arrayau1 = array();
        $arrayau2 = array();
        $arrayau3 = array();
        $arrayau4 = array();
        foreach ($ua_thread_authors as $key => $value) {
            $tmp = $value->author_id;
            array_push($arrayid1, $tmp);
        }
        foreach ($ua_archive_authors as $key => $value) {
            $tmp = $value->author_id;
            array_push($arrayid2, $tmp);
        }
        foreach ($ua_replies_authors as $key => $value) {
            $tmp = $value->author_id;
            array_push($arrayid3, $tmp);
        }
        foreach ($ua_subscription_authors as $key => $value) {
            $tmp = $value->user_id;
            array_push($arrayid4, $tmp);
        }
        foreach ($homestead_thread_email as $key => $value) {
            $tmp = $value->email;
            $tmp_id =  USER::select('id')->where('email', '=', $tmp)->get()[0]->id;
            array_push($arrayau1, $tmp_id);
        }
        foreach ($homestead_archive_email as $key => $value) {
            $tmp = $value->email;
            $tmp_id =  USER::select('id')->where('email', '=', $tmp)->get()[0]->id;
            array_push($arrayau2, $tmp_id);
        }
        foreach ($homestead_replies_email as $key => $value) {
            $tmp = $value->email;
            $tmp_id =  USER::select('id')->where('email', '=', $tmp)->get()[0]->id;
            array_push($arrayau3, $tmp_id);
        }
        foreach ($homestead_subscription_email as $key => $value) {
            $tmp = $value->email;
            $tmp_id =  USER::select('id')->where('email', '=', $tmp)->get()[0]->id;
            array_push($arrayau4, $tmp_id);
        }
        for($i = 0; $i < count($arrayid1); $i++){
            Thread::where('author_id', '=', $arrayid1[$i])->update(['author_id' => $arrayau1[$i]]);
        }
        for($i = 0; $i < count($arrayid2); $i++){
            Archive::where('author_id', '=', $arrayid2[$i])->update(['author_id' => $arrayau2[$i]]);
        }
        for($i = 0; $i < count($arrayid3); $i++){
            Reply::where('author_id', '=', $arrayid3[$i])->update(['author_id' => $arrayau3[$i]]);
        }
        for($i = 0; $i < count($arrayid4); $i++){
            Subscription::where('user_id', '=', $arrayid4[$i])->update(['user_id' => $arrayau4[$i]]);
        }
    }

    public function addCategoeyTypeToCategoryThread()
    {
        DB::update('update category_threads set category_type = "categories"');
    }
}
