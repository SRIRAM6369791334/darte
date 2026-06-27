<?php

namespace App\Http\Controllers;

use App\Models\HomePromotion;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Services\SeoService;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $instaPosts = HomePromotion::where('status', 1)
    //         ->orderBy('sort_order', 'asc')
    //         ->limit(6)
    //         ->get();

    //     return view('pages.home', compact('instaPosts'));
    // }
//     public function index()
// {
//     $instaPosts = HomePromotion::orderBy('id', 'desc')
//         ->limit(6)
//         ->get();

//     return view('pages.home', compact('instaPosts'));
// }




    public function index()
    {
        $instaPosts = HomePromotion::orderBy('id', 'desc')
            ->limit(6)
            ->get();

        $blogs = Blog::orderBy('id', 'desc')->limit(3)->get();
        
        // Fetch specific product variants for dynamic homepage sections
        $trendingProducts = \App\Models\ProductVarient::where('hot_deals', 1)->with('product')->get();
        $popularProducts = \App\Models\ProductVarient::where('Popular_products', 1)->with('product')->get();

        $bannerImages = \App\Models\WebImage::all();

        $homeCategories = Category::orderBy('id', 'asc')->get();
        $giftCategories = \App\Models\GiftCategory::where('status', 1)->orderBy('id', 'asc')->take(2)->get();
        $allProducts = \App\Models\Product::orderBy('id', 'desc')->limit(20)->get();
        $reviews = \App\Models\Review::where('status', 1)->with(['product', 'variant'])->orderBy('id', 'desc')->get();

        return view('pages.home', compact('instaPosts', 'blogs', 'trendingProducts', 'popularProducts', 'bannerImages', 'giftCategories', 'allProducts', 'homeCategories', 'reviews'));
    }
}

