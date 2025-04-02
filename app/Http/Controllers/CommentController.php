<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;


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

    public function update(Request $request, Comment $comment) {

        Gate::authorize('update', $comment);
        $fields = $request->validate([
            'content' => 'required|string|max:255'
        ]);

        $comment->update([
            'content' => $fields['content']
        ]);

        return $comment;
    }

    public function destroy(Post $post, Comment $comment) {
        Gate::authorize('delete', $comment);
        $comment->delete();

        return ['message' => "The comment ($comment->id) has been deleted"];
    }
}
