<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// トップページ
Route::get('/', [ProductController::class, 'index'])->name('top');

// 商品一覧（ログイン済み専用）
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // 商品一覧
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // 新規登録フォーム
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // 保存

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // 編集フォーム
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // 更新

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // 削除
});
