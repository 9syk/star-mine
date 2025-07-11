<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
public function index(Request $request)
    {
        if (Auth::check()) {
            // ログイン済み → 商品一覧表示
            $products = Product::paginate(20);
            return view("index", ["products" => $products]);
        } else {
            // 未ログイン → welcomeページなどにリダイレクト
            return view("welcome"); // もしくは redirect('/')
        }
    }
}
