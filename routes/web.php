<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('Home');
});

Route::get('/debug-css', function () {
    $files = scandir(public_path('css'));
    return response()->json($files);
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class,'logout'])->name('logout');
Route::get('/explore', [UserController::class,'explore'])->name('explore');
Route::get('/blog/{slug}', [UserController::class, 'read'])->name('read');

Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/dashboard', [DashboardController::class,'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/analytics/traffic', [DashboardController::class, 'traffic'])->name('analytics.traffic');
    // Route::get('/blog', [PostController::class, 'browse']);
    // Route::get('/blog/{post}', [PostController::class, 'show']);
});