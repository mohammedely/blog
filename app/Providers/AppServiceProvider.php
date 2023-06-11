<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        $setting = \App\Models\Setting::first();
        Paginator::useBootstrap();
        
        $recent_posts = [];
        if ($setting !== null) {
            $recent_posts = \App\Models\Post::orderBy('id', 'desc')->limit($setting->recent_limit)->get();
        }
        View::share('recent_posts', $recent_posts);
        
        $popular_posts = [];
        if ($setting !== null) {
            $popular_posts = \App\Models\Post::orderBy('views', 'desc')->limit($setting->popular_limit)->get();
        }
        View::share('popular_posts', $popular_posts);
    }
}
