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
