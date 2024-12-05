<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::post('/articles/{article}/update', [UserController::class, 'update'])->name('articles.update');
Route::get('/articles/{article}/remove', [UserController::class, 'remove'])->name('articles.remove');
Route::get('/listauteur', [PublicController::class, 'listauteur'])->name('public.listauteur');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/articles/create', [UserController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [UserController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [UserController::class, 'edit'])->name('articles.edit');
    Route::get('/articles/like/{id}', [ArticleController::class, 'like'])->name('article.like');
    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';



Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
//Route::get('/{user}', [PublicController::class, 'indexByCategory'])->name('public.indexByCategory');
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');


