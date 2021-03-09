<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Posts\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Post $post){
        return $user->id === $post->user_id;

    }
}
