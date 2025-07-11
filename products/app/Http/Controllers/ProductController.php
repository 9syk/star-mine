<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {        
        $products = Product::paginate(20);
        $data = [
            "products" => $products,
        ];
        return view("index", $data);
    }
}