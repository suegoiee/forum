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
        foreach($homestead_threads as $homestead_thread){
            Thread::firstOrNew(
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
            Archive::firstOrNew(
                [
                    'id' => $homestead_article->id, 
                    'author_id' => $homestead_article->author_id,
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
            Category::firstOrNew(
                [
                    'id' => $homestead_category->id, 
                    'name' => $homestead_category->name,
                    'slug' => $homestead_category->slug
                ]
            );
        }
        foreach($homestead_categorie_threads as $homestead_categorie_thread){
            DB::statement("SET SQL_SAFE_UPDATES = 0;");
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
            DB::statement("SET SQL_SAFE_UPDATES = 1;");
        }
        foreach($homestead_replies as $homestead_reply){
            Schema::disableForeignKeyConstraints();
            DB::statement("SET SQL_SAFE_UPDATES = 0;");
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
            DB::statement("SET SQL_SAFE_UPDATES = 1;");
            Schema::enableForeignKeyConstraints();
        }
        foreach($homestead_subscriptions as $homestead_subscription){
            DB::statement("SET SQL_SAFE_UPDATES = 0;");
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
            DB::statement("SET SQL_SAFE_UPDATES = 1;");
        }
        DB::statement("SET SQL_SAFE_UPDATES = 1;");
    }

        public function changeAuthorIdToUaVersion()
        {
        set_time_limit(0);
        $homestead_authors = Archive::select('author_id')->distinct()->get();
        $homestead_user_email = DB::connection('mysql_3')->table('users')->select('email')->wherein('id', $homestead_authors)->distinct()->get();
        $array1 = array();
        $array2 = array();
        foreach ($homestead_authors as $key => $value) {
            $tmp = $value->author_id;
            array_push($array1, $tmp);
        }
        foreach ($homestead_user_email as $key => $value) {
            $tmp = $value->email;
            $tmp_id =  USER::select('id')->where('email', '=', $tmp)->get()[0]->id;
            array_push($array2, $tmp_id);
        }
        for($i = 0; $i < count($array1); $i++){
            echo '</br>' . $array1[$i] . ' to ' . $array2[$i] . '</br>';
            /*Thread::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);
            Reply::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);*/
            Archive::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);
        }
    }

    public function addCategoeyTypeToCategoryThread()
    {
        DB::update('update category_threads set category_type = "categories"');
    }
}
