<?php

namespace App\Providers;

use App\Observers\ReplyObserver;
use App\Reply;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Topic::observe(\App\Observers\TopicObserver::class);
        Reply::observe(ReplyObserver::class);
    }
}
