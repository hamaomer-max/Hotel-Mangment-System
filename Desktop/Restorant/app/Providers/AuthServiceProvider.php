<?php
// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Policies\CategoryPolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
   
     protected $policies = [
        Category::class => CategoryPolicy::class,
    ];
    
    public function boot()
    {
        $this->registerPolicies();

    }
}


