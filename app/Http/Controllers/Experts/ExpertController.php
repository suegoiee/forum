<?php

namespace App\Http\Controllers\Experts;

/*
use App\Jobs\BanUser;
use App\Jobs\UnbanUser;
use App\Jobs\DeleteUser;
use App\Policies\UserPolicy;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\VerifyAdmins;*/
use App\User;
use App\Models\Expert;
use App\Http\Controllers\Controller;

class ExpertController extends Controller
{
    public function overview()
    {
        $experts = Expert::with(['userRelation'])->has('userRelation')->get();
        return view('experts.overview', compact('experts'));
    }

    public function show(Expert $expert)
    {
        return view('experts.profile', compact('expert'));
    }
}
