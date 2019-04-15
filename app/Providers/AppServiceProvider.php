<?php

namespace App\Providers;

use Horizon;
use App\Models\Thread;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
