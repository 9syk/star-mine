<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// トップページ
Route::get('/', [HomeController::class, 'index'])->name('top');

// 商品一覧（ログイン済み専用）
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});
