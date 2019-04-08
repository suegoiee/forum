<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VerifiedUserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    public function verified(Request $request)
    {
        User::where('email', $request->input('email'))->update(['confirmed'=>1]);
       
        return response()->json(['data'=>['verified'=>1]]);
    }
}
