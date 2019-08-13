<?php

namespace App\Providers;

use Horizon;
use Carbon\Carbon;
use App\Models\Expert;
use App\Models\Thread;
use App\Models\Archive;
use App\Models\Category;
use App\Models\OnlineCourse;
use App\Models\PhysicalCourse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootEloquentMorphs();
        $this->bootMacros();
        $this->bootHorizon();
        Carbon::setLocale('zh_TW');
        Schema::defaultStringLength(191);
    }

    private function bootEloquentMorphs()
    {
        Relation::morphMap([
            Thread::TABLE => Thread::class,
            Category::TABLE => Category::class,
            Archive::TABLE => Archive::class,
            OnlineCourse::TABLE => OnlineCourse::class,
            PhysicalCourse::TABLE => PhysicalCourse::class,
            Expert::TABLE => Expert::class,
        ]);
    }

    public function bootMacros()
    {
        require base_path('resources/macros/blade.php');
    }

    public function bootHorizon()
    {
        Horizon::routeMailNotificationsTo($horizonEmail = config('lio.horizon.email'));
        Horizon::routeSlackNotificationsTo(config('lio.horizon.webhook'));

        Horizon::auth(function ($request) use ($horizonEmail) {
            return auth()->check() && auth()->user()->emailAddress() === $horizonEmail;
        });
    }
}
