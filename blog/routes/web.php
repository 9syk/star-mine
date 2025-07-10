<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookmarkController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/articles', ArticleController::class);
    Route::post('/articles/{article}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/articles/{article}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('/bookmarks', [ArticleController::class, 'bookmark_articles'])->name('bookmarks');
});