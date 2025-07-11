<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
public function index(Request $request)
{
    if (!Auth::check()) {
        return view("welcome");
    }

    $query = Product::query();

    // カテゴリ絞り込み
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // キーワード（商品名 or メーカー）検索
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('maker', 'like', "%{$keyword}%");
        });
    }

    // 最低価格
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    // 最高価格
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // 並び順
    switch ($request->sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc'); // 登録順（最新順）
    }

    $products = $query->paginate(20);

    return view("index", ["products" => $products]);
}

public function create() {
    return view('products.create'); // フォーム画面へ
}

public function store(Request $request) {
    // バリデーション後、保存
    Product::create($request->all());
    return redirect()->route('products.index')->with('success', '商品を登録しました');
}

public function edit(Product $product) {
    return view('products.edit', compact('product'));
}

public function update(Request $request, Product $product) {
    $product->update($request->all());
    return redirect()->route('products.index')->with('success', '商品を更新しました');
}

public function destroy(Product $product) {
    $product->delete();
    return redirect()->route('products.index')->with('success', '商品を削除しました');
}
}
