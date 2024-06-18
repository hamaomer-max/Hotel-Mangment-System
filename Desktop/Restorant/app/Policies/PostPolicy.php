<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Category $category)
{
    return $user->id === $category->user_id;
}

}
