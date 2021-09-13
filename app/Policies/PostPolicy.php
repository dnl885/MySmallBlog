<?php

namespace App\Policies;

use App\Constants\RoleConstants;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function view(User $user){
        return $user->hasRole(RoleConstants::ROLE_ADMIN) ||
            $user->hasRole(RoleConstants::ROLE_CONTENT_CREATOR);
    }

    public function create(User $user)
    {
        return $user->hasRole(RoleConstants::ROLE_ADMIN) ||
               $user->hasRole(RoleConstants::ROLE_CONTENT_CREATOR);
    }

    public function update(User $user, Post $post)
    {
        return $user->id == $post->user->id
            || $user->isAdmin();
    }

    public function delete(User $user, Post $post)
    {
        return $user->id == $post->user->id
            || $user->isAdmin();
    }

    public function forceDelete(User $user, Post $post)
    {
        return $user->id == $post->user->id
            || $user->isAdmin();
    }
}
