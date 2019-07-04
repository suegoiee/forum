<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Models\Tag;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Archive;
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

    public function changeAuthorIdToUaVersion()
    {
        set_time_limit(0);
        $homestead_authors = Thread::select('author_id')->distinct()->get();
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
        print_r($array1);
        print_r($array2);
        for($i = 0; $i < count($array1); $i++){
            echo '</br>' . $array1[$i] . ' to ' . $array2[$i] . '</br>';
            /*Thread::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);
            Reply::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);*/
            Archive::where('author_id', '=', $array1[$i])->update(['author_id' => $array2[$i]]);
        }
        //echo $ua_authors = USER::select('id')->wherein('email', $homstead_authors)->get();
        //print_r( $ua_authors );
        //print_r($articles);
        /*foreach($forum_authors as $key => $forum_author){
            print_r($forum_author);
            echo "</br>";
            echo "</br>";
            echo "</br>";
        }*/
        /*foreach ($articles as $key => $article) {
            //print_r($forum_user);
            echo $article->author_id;
            echo $forum_authors = DB::connection('mysql_3')->table('users')->where('id', '=', $article->author_id)->get();
            foreach ($forum_users as $key2 => $forum_user){
                if($forum_user->id == $article->author_id){
                    echo $forum_user->email;
                }
            }
            echo "</br>";
            echo "</br>";*/
            /*echo $article->title.'<br>';
            array_push($archives, ['author_id'=>0, 'subject'=>$article->title,'slug'=>$article->generateUniqueSlug(), 'body'=>$article->content,'solution_reply_id'=>0, 'created_at'=>$article->created_at ,'updated_at'=>$article->updated_at]);*/
        //}
        //DB::connection('mysql_3')->table('archives')->insert($archives);
    }
}
