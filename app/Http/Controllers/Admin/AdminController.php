<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Tag;
use App\Models\Permission;
use App\Models\CategoryProduct;
use App\Jobs\UpdatePermission;
use App\Jobs\DeletePermission;
use App\Queries\SearchUsers;
use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAdmins;
use App\Http\Requests\DeletePermissionRequest;
use App\Http\Requests\PermissionRequest;
use App\Policies\PermissionPolicy;
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
        $tags = Tag::all();
        //$test = User::all();
        return view('admin.overview', compact('masters', 'search', 'tags', 'users'));
    }

    public function category()
    {
        $users = User::all();
        $masters = Permission::with(['permissionRelation', 'categoriesRelation'])->get();
        $tags = Tag::all();
        $categoryproduct = CategoryProduct::with(['productRelation', 'categoriesRelation'])->get();
        return view('admin.category', compact('masters', 'search', 'tags', 'users', 'categoryproduct'));
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

    public function permission()
    {
        $this->authorize(ThreadPolicy::UPDATE, $thread);
        $search = request('search');
        //$users = $search ? SearchUsers::get($search) : User::findAllPaginated();
        $users = User::with('permissionRelation')->get();
        //$test = User::all();
        return view('admin.overview', compact('users', 'search', 'test'));
    }
}
