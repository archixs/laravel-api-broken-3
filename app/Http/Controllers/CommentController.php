<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class CommentController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function comment(Request $request, Post $post) {
        $fields = $request->validate([
            'content' => 'required|string|max:255'
        ]);

        $comment = $post->comment()->create([
            'content' => $fields['content'],
            'user_id' => $request->user()->id
        ]);

        return $comment;
    }

    public function destroy(Post $post, Comment $comment) {
        
    }
}
