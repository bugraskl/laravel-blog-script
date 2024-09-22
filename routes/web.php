<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewCategoryController;
use App\Http\Controllers\NewPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/writers', [WriterController::class, 'index'])->name('writers.index');
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');

Route::middleware(['auth'])->group(function () {
    Route::get('/new-post', [NewPostController::class, 'index'])->name('new-post');
    Route::post('/new-post', [NewPostController::class, 'store'])->name('new-post.post');
    Route::get('/new-category', [NewCategoryController::class, 'index'])->name('new-category');
    Route::post('/new-category', [NewCategoryController::class, 'store'])->name('new-category.post');
    Route::get('/my-posts', [PostController::class, 'index'])->name('my-posts.index');
    Route::get('/post-edit/{id}', [PostController::class, 'edit'])->name('post-edit');
    Route::post('/post-edit/{id}', [PostController::class, 'update'])->name('post-edit.post');
    Route::delete('/post-delete', [PostController::class, 'destroy'])->name('post-delete');
});

