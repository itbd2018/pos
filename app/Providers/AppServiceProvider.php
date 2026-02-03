<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Category;


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
        View::composer('FrontEnd.include.header', function ($view){
            $view->with(
//                'menu_featured_categories', Category::orderBy('name_en','ASC')
//                    ->where('status','=',1)
//                    ->where('is_featured', 1)
//                    ->get(),
                'menu_featured_categories', Category::orderBy('id','ASC')
                    ->where('is_featured','=',1)
                    ->where('type','=',1)
                    ->where('status','=',1)
                    ->get()
            );

        });

    }
}
