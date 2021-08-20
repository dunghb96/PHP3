<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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

        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        View::share('school_name','FPT Polytechnic'); //ví dụ về view share

        // View::composer('admin.room.index', function ($view) { //ví dụ về view composer
        //     $user=User::all();
        //     $view->with('system_user',$user);
        // });
    }
}
