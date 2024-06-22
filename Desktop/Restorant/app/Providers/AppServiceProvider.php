<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         view()->composer('layouts.admin', function ($view) {
        
        $category = Category::select('id','name_en','name_ar','name_ckb')
        ->with(['sub_categories' => function($q){
            $q->select('id','name_en','name_ar','name_ckb' ,'category_id' );
        }])
        ->get()
        ->each(function($row){
            $row->setAppends([]);
        });
        $view->with('category', $category);

         });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
