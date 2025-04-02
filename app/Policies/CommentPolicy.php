<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;



class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id ? Response::allow() : Response::deny("You do not own this comment");
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id ? Response::allow() : Response::deny("You do not own this comment");
    }
}
