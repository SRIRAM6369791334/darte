<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVarient;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * View the Cart items for the authenticated user.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $cartItems = Cart::whereHas('product')
            ->with(['product.variants', 'variant'])
            ->where('user_id', $userId)
            ->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? ($item->product->product_regular_price ?? $item->product->product_mrp_price);
            $subtotal += $price * $item->product_quantity;
        }

        return view('pages.cart', compact('cartItems', 'subtotal'));
    }

    /**
     * Add a product to the cart with stock validation.
     */
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'status' => 'unauthenticated',
                'message' => 'Please login to add items to your cart.'
            ], 401);
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id'); // Optional
        $quantity = $request->input('quantity', 1);

        // 1. Stock Validation
        if ($variantId) {
            $variant = ProductVarient::find($variantId);
            if (!$variant || $variant->product_qty < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Requested quantity is not available in stock.'
                ], 400);
            }
        } else {
            // If no specific variant, check the first available variant or product base quantity
            $product = Product::with('variants')->find($productId);
            if (!$product) {
                 return response()->json([
                    'success' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            // Default to first variant if exists, otherwise check product_quantity
            $targetQty = $product->variants->first()->product_qty ?? $product->product_quantity;
            if ($targetQty < $quantity) {
                 return response()->json([
                    'success' => false,
                    'message' => 'This product is currently out of stock.'
                ], 400);
            }
            
            // If no variantId provided but variants exist, use the first one
            $variantId = $product->variants->first()->id ?? null;
        }

        // 2. Check if item already exists in cart
        $existingCart = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('product_varient_id', $variantId)
            ->first();

        if ($existingCart) {
            return response()->json([
                'success' => true,
                'message' => 'This item is already in your cart!'
            ]);
        } else {
            // Create new cart entry
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'product_varient_id' => $variantId,
                'product_quantity' => $quantity,
                'ip_addresscart' => $request->ip(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }

    /**
     * Update the quantity of a cart item with stock validation.
     */
    public function updateQuantity(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $cartId = $request->input('cart_id');
        $action = $request->input('action'); // 'increment' or 'decrement'
        $cart = Cart::find($cartId);

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
        }

        $newQty = $cart->product_quantity;
        if ($action == 'increment') {
            $newQty++;
        } elseif ($action == 'decrement' && $newQty > 1) {
            $newQty--;
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid action or minimal quantity reached.']);
        }

        // Stock Validation
        if ($cart->product_varient_id) {
            $stock = ProductVarient::find($cart->product_varient_id)->product_qty;
        } else {
            $stock = Product::find($cart->product_id)->product_quantity;
        }

        if ($stock < $newQty) {
            return response()->json(['success' => false, 'message' => 'Stock limit reached.'], 400);
        }

        $cart->update(['product_quantity' => $newQty]);

        // Recalculate Cart Total
        $userId = Auth::id();
        $cartItems = Cart::with(['product', 'variant'])->where('user_id', $userId)->get();
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? ($item->product->product_regular_price ?? $item->product->product_mrp_price);
            $cartTotal += $price * $item->product_quantity;
        }

        $itemPrice = $cart->variant->offer_price ?? ($cart->product->product_regular_price ?? $cart->product->product_mrp_price);
        $itemSubtotal = $itemPrice * $newQty;

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated.',
            'new_qty' => $newQty,
            'item_subtotal' => (float)$itemSubtotal,
            'cart_total' => (float)$cartTotal
        ]);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $cartId = $request->input('cart_id');
        $cart = Cart::find($cartId);

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
    }

    /**
     * Remove all items from the cart for the authenticated user.
     */
    public function removeAll()
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json(['success' => true, 'message' => 'All items removed from cart.']);
    }

    /**
     * Update the size (variant) of a cart item with stock validation and merging.
     */
    public function updateSize(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $cartId = $request->input('cart_id');
        $variantId = $request->input('variant_id');
        $cart = Cart::find($cartId);

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
        }

        $variant = ProductVarient::find($variantId);
        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Variant not found.'], 404);
        }

        // Check stock
        if ($variant->product_qty < $cart->product_quantity) {
            return response()->json(['success' => false, 'message' => 'Requested quantity is not available for this size.'], 400);
        }

        // Check if another item with the same variant already exists in the cart
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $cart->product_id)
            ->where('product_varient_id', $variantId)
            ->where('id', '!=', $cartId)
            ->first();

        if ($existingCart) {
            // Merge quantities
            $newQty = $existingCart->product_quantity + $cart->product_quantity;
            
            // Re-check stock for merged quantity
            if ($variant->product_qty < $newQty) {
                 return response()->json(['success' => false, 'message' => 'Cannot change size. Merged quantity exceeds stock limit.'], 400);
            }

            $existingCart->update(['product_quantity' => $newQty]);
            $cart->delete();
            
            // Recalculate total for return
            $cartTotal = $this->calculateCartTotal(Auth::id());

            return response()->json([
                'success' => true,
                'message' => 'Size updated and merged with existing item.',
                'merged' => true,
                'new_cart_id' => $existingCart->id,
                'new_qty' => $newQty,
                'item_subtotal' => (float)(($variant->offer_price ?? ($cart->product->product_regular_price ?? $cart->product->product_mrp_price)) * $newQty),
                'cart_total' => (float)$cartTotal
            ]);
        }

        // Update variant
        $cart->update(['product_varient_id' => $variantId]);

        // Recalculate totals
        $cartTotal = $this->calculateCartTotal(Auth::id());
        $itemPrice = $variant->offer_price ?? ($cart->product->product_regular_price ?? $cart->product->product_mrp_price);
        $itemSubtotal = $itemPrice * $cart->product_quantity;

        return response()->json([
            'success' => true,
            'message' => 'Size updated.',
            'item_price' => (float)$itemPrice,
            'item_subtotal' => (float)$itemSubtotal,
            'cart_total' => (float)$cartTotal
        ]);
    }

    private function calculateCartTotal($userId)
    {
        $cartItems = Cart::with(['product', 'variant'])->where('user_id', $userId)->get();
        $total = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->offer_price ?? ($item->product->product_regular_price ?? $item->product->product_mrp_price);
            $total += $price * $item->product_quantity;
        }
        return $total;
    }

    /**
     * Return live cart & wishlist counts for the header badges.
     */
    public function getCounts()
    {
        if (!Auth::check()) {
            return response()->json([
                'cart_count' => 0,
                'wishlist_count' => 0,
                'cart_product_ids' => [],
                'wishlist_product_ids' => [],
                'cart_variant_ids' => [],
                'wishlist_variant_ids' => [],
                'html' => ''
            ]);
        }

        $userId = Auth::id();
        $cartCount = Cart::where('user_id', $userId)->count();
        $wishlistCount = \App\Models\Wishlist::where('user_id', $userId)->count();

        $cartProductIds = Cart::where('user_id', $userId)->pluck('product_id')->unique()->toArray();
        $wishlistProductIds = \App\Models\Wishlist::where('user_id', $userId)->pluck('product_id')->unique()->toArray();

        $cartVariantIds = Cart::where('user_id', $userId)->pluck('product_varient_id')->unique()->toArray();
        $wishlistVariantIds = \App\Models\Wishlist::where('user_id', $userId)->pluck('product_varient_id')->unique()->toArray();

        $html = view('partials.sidebar-cart')->render();

        return response()->json([
            'cart_count'     => $cartCount,
            'wishlist_count' => $wishlistCount,
            'cart_product_ids' => $cartProductIds,
            'wishlist_product_ids' => $wishlistProductIds,
            'cart_variant_ids' => $cartVariantIds,
            'wishlist_variant_ids' => $wishlistVariantIds,
            'html'           => $html
        ]);
    }
}
