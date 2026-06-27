<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('variants')->latest()->paginate(12);
        $categories = Category::all();
        $sizes = ProductVarient::select('size_value')->distinct()->pluck('size_value');

        return view('pages.shop', compact('products', 'categories', 'sizes'));
    }
}
