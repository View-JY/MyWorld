<?php

namespace App\Policies;

use App\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    // 判断删除权限
    public function destroy(User $user, Comment $comment)
    {
      return $user ->id === $comment ->user_id;
    }
}
