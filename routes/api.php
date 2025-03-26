<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::get('/{user}/posts', function (User $user) {
    return $user->posts;
});

Route::post('/{post}/comment', [CommentController::class, 'comment']);
Route::post('/posts/{post}/comments', [CommentController::class, 'index']);
Route::delete('/posts/{post}/comment/{comment}', [CommentController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');;
