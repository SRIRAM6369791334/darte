<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\Category;
use App\Models\Review;
use App\Models\ProductOrderItem;
use App\Services\SeoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request, $categorySlug = null)
    {
        $globalMinPrice = \App\Models\ProductVarient::min('offer_price') ?? 0;
        $globalMaxPrice = \App\Models\ProductVarient::max('offer_price') ?? 1000;

        // ── Resolve category from URL slug (/shop/kids) or query param (?category=38) ──
        $activeCategoryId = $request->input('category');
        if ($categorySlug) {
            // Find all categories and match by slug
            $allCategories = Category::all();
            $matched = $allCategories->first(fn($c) => Str::slug($c->category_name) === $categorySlug);
            if ($matched) {
                $activeCategoryId = $matched->id;
            }
        }

        $minPriceInput = $request->input('min_price');
        $maxPriceInput = $request->input('max_price');

        $minPrice = $globalMinPrice;
        $maxPrice = $globalMaxPrice;
        $applyPriceFilter = false;

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = is_numeric($minPriceInput) ? (float)$minPriceInput : $globalMinPrice;
            $maxPrice = is_numeric($maxPriceInput) ? (float)$maxPriceInput : $globalMaxPrice;

            // Only apply price filter when the user has set a CUSTOM range
            if ($minPrice > $globalMinPrice || $maxPrice < $globalMaxPrice) {
                $applyPriceFilter = true;
            }
        }

        $applySizeFilter = $request->filled('size');
        $selectedSize    = $request->input('size'); // can be string or array
        $selectedSizes   = is_array($selectedSize) ? $selectedSize : (array) $selectedSize;

        // Build base query — eager load variants filtered by active filters for display
        $query = Product::with([
            'variants' => function ($q) use ($selectedSizes, $minPrice, $maxPrice, $applySizeFilter, $applyPriceFilter) {
                if ($applySizeFilter) {
                    $q->whereIn('varient', $selectedSizes);
                }
                if ($applyPriceFilter) {
                    $q->whereBetween('offer_price', [$minPrice, $maxPrice]);
                }
                $q->orderBy('offer_price', 'asc');
            },
            'reviews',
            'category',
        ]);

        // 1. Search Filter
        if ($request->filled('dzSearch')) {
            $search = $request->input('dzSearch');
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                  ->orWhere('product_description', 'like', "%{$search}%");
            });
        }

        // 2. Category Filter
        if ($activeCategoryId) {
            $query->where('category_id', $activeCategoryId);
        }

        // 3a. Size Filter — independent whereHas (size must be one of the selected)
        if ($applySizeFilter) {
            $query->whereHas('variants', function ($q) use ($selectedSizes) {
                $q->whereIn('varient', $selectedSizes);
            });
        }

        // 3b. Price Filter — independent whereHas (only price must match)
        if ($applyPriceFilter) {
            $query->whereHas('variants', function ($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('offer_price', [$minPrice, $maxPrice]);
            });
        }

        // 4. Sorting logic
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'popularity':
                $query->withCount('orderItems')->orderBy('order_items_count', 'desc');
                break;
            case 'rating':
                // MySQL: use ISNULL trick to push products without ratings to the end
                $query->withAvg('reviews', 'ratings')
                      ->orderByRaw('ISNULL(reviews_avg_ratings) ASC')
                      ->orderBy('reviews_avg_ratings', 'desc');
                break;
            case 'price_low':
                $query->addSelect([
                    'min_offer_price' => \App\Models\ProductVarient::select('offer_price')
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('offer_price', 'asc')
                        ->limit(1)
                ])->orderBy('min_offer_price', 'asc');
                break;
            case 'price_high':
                $query->addSelect([
                    'min_offer_price' => \App\Models\ProductVarient::select('offer_price')
                        ->whereColumn('product_id', 'products.id')
                        ->orderBy('offer_price', 'desc')
                        ->limit(1)
                ])->orderBy('min_offer_price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $perPage = (int) $request->input('per_page', 12);
        if (!in_array($perPage, [9, 12, 14, 18, 24])) {
            $perPage = 12;
        }

        $products = $query->paginate($perPage)->withQueryString();
        
        $categories = Category::withCount('products')->get();
        $sizes = ProductVarient::select('varient')->whereNotNull('varient')->where('varient', '!=', '')->distinct()->pluck('varient');

        // Pass active category info for view to use in breadcrumb and active state
        $activeCategory = $activeCategoryId ? $categories->firstWhere('id', $activeCategoryId) : null;

        // Build shop-page SEO (category-aware)
        $seoService = app(SeoService::class);
        // Only use DB meta if it's an EXACT match to avoid wildcard ('/shop/*') overriding all categories
        $path = request()->getPathInfo();
        $dbMeta = \App\Models\Seotag::where('url', $path)->first();
        
        $meta = $dbMeta ?? $seoService->buildShopMeta($activeCategory);

        view()->share('meta', $meta);

        return view('pages.shop', compact(
            'products', 'categories', 'sizes',
            'globalMinPrice', 'globalMaxPrice',
            'activeCategoryId', 'activeCategory', 'categorySlug'
        ));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'variants', 'reviews' => function($q) {
            $q->where('status', 1)->with('user');
        }])->where('slug', $slug)->firstOrFail();
        
        // Fetch related products from the same category
        $relatedProducts = Product::with('variants')
            ->where('category_id', $product->category_id)
            ->where('slug', '!=', $slug)
            ->limit(8)
            ->get();

        $hasPurchased = false;
        if (Auth::check()) {
            $hasPurchased = ProductOrderItem::where('product_id', $product->id)
                ->whereHas('order', function($q) {
                    $q->where('user_id', Auth::id())
                      ->whereIn('status', ['delivered', 'completed']);
                })->exists();
        }

        // Fetch Next and Previous products for navigation
        $prevProduct = Product::where('id', '<', $product->id)->orderBy('id', 'desc')->first();
        $nextProduct = Product::where('id', '>', $product->id)->orderBy('id', 'asc')->first();

        // Build dynamic product SEO meta
        $seoService = app(SeoService::class);
        $meta = $seoService->buildProductMeta($product, $product->variants->first());
        view()->share('meta', $meta);

        return view('pages.shop-details', compact('product', 'relatedProducts', 'hasPurchased', 'prevProduct', 'nextProduct'));
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'ratings' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
            'prod_id' => 'required|exists:products,id',
            'prod_var_id' => 'nullable|exists:product_varient,id',
        ]);

        $hasPurchased = ProductOrderItem::where('product_id', $request->prod_id)
            ->whereHas('order', function($q) {
                $q->where('user_id', Auth::id())
                  ->whereIn('status', ['delivered', 'completed']);
            })->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products you have purchased.');
        }

        // Check if user already reviewed
        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('prod_id', $request->prod_id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'prod_id' => $request->prod_id,
            'prod_var_id' => $request->prod_var_id,
            'ratings' => $request->ratings,
            'review' => $request->comment,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
