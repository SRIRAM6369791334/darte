<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Services\SeoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                
                $carts = Cart::whereHas('product')
                    ->with(['product.variants', 'variant'])
                    ->where('user_id', $userId)
                    ->get();
                
                $wishlistItems = Wishlist::whereHas('product')
                    ->with(['product.variants', 'variant'])
                    ->where('user_id', $userId)
                    ->get();
                
                $cartCount = $carts->count();
                $wishlistCount = $wishlistItems->count();
                
                $headerSubtotal = 0;
                foreach ($carts as $item) {
                    $price = $item->variant->offer_price 
                        ?? ($item->product->product_regular_price 
                        ?? ($item->product->product_mrp_price 
                        ?? ($item->product->variants->first()->offer_price ?? 0)));
                    $headerSubtotal += $price * $item->product_quantity;
                }
                
                $view->with([
                    'cartCount' => $cartCount,
                    'wishlistCount' => $wishlistCount,
                    'headerCartItems' => $carts,
                    'headerWishlistItems' => $wishlistItems,
                    'headerSubtotal' => $headerSubtotal
                ]);
            } else {
                $view->with([
                    'cartCount' => 0,
                    'wishlistCount' => 0,
                    'headerCartItems' => collect(),
                    'headerWishlistItems' => collect(),
                    'headerSubtotal' => 0
                ]);
            }

            // Share coupons globally for both auth and guest (top slider)
            $view->with('headerCoupons', Coupon::where('start_date', '<=', date('Y-m-d'))
                ->where('end_date', '>=', date('Y-m-d'))
                ->get());

            // Share dynamic categories and Discovery products for search bar
            $view->with('headerCategories', \App\Models\Category::all());
            $view->with('headerRandomProducts', \App\Models\Product::with('variants')->inRandomOrder()->limit(10)->get());

            // Share dynamic filter data for sidebar
            $view->with('headerCategoriesWithCounts', \App\Models\Category::withCount('products')->get());
            $view->with('headerAllSizes', \App\Models\ProductVarient::whereNotNull('varient')->distinct()->pluck('varient'));
            $view->with('headerGlobalMinPrice', \App\Models\ProductVarient::min('offer_price') ?? 0);
            $view->with('headerGlobalMaxPrice', \App\Models\ProductVarient::max('offer_price') ?? 1000);

            // SEO Implementation
            // IMPORTANT: Only set $meta if the controller has NOT already set it.
            // We check both the specific view data AND the globally shared data (set via View::share).
            $viewData = $view->getData();
            $sharedData = View::getShared();

            if (!isset($viewData['meta']) && !isset($sharedData['meta'])) {
                $seoService = app(SeoService::class);
                $metaData = $seoService->getMetaForCurrentUrl();

                if (!$metaData) {
                    // Cast default array to object for consistent property access in Blade
                    $metaData = (object) $seoService->getDefaultMeta();
                }

                $view->with('meta', $metaData);
            }
        });
    }
}
