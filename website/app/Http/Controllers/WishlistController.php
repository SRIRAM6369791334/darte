<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVarient;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * View the Wishlist items for the authenticated user.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $wishlistItems = Wishlist::whereHas('product')
            ->with(['product', 'variant'])
            ->where('user_id', $userId)
            ->get();

        return view('pages.wishlist', compact('wishlistItems'));
    }

    /**
     * Add a product to the wishlist with stock validation.
     */
    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'status' => 'unauthenticated',
                'message' => 'Please login to add items to your wishlist.'
            ], 401);
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $variantId = $request->input('product_varient_id');


        // 2. Check if item already exists in wishlist
        $existingWish = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('product_varient_id', $variantId)
            ->first();

        if ($existingWish) {
             return response()->json([
                'success' => true,
                'message' => 'This item is already in your wishlist!'
            ]);
        } 

        // 3. Create new wishlist entry
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'product_varient_id' => $variantId,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully!'
        ]);
    }

    /**
     * Move an item from the wishlist to the cart.
     */
    public function moveToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $wishId = $request->input('wishlist_id');
        $wish = Wishlist::find($wishId);

        if (!$wish) {
            return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
        }

        // Reuse CartController addToCart logic if possible, or just create cart entry here
        $userId = Auth::id();
        
        // Check for existing cart item
        $existingCart = Cart::where('user_id', $userId)
            ->where('product_id', $wish->product_id)
            ->where('product_varient_id', $wish->product_varient_id)
            ->first();

        $quantity = $wish->product_quantity ?? 1;

        if ($existingCart) {
            $newQty = $existingCart->product_quantity + $quantity;
            
            // Re-check stock for the new total quantity
            if ($wish->product_varient_id) {
                $stock = ProductVarient::find($wish->product_varient_id)->product_qty;
            } else {
                $stock = Product::find($wish->product_id)->product_quantity;
            }

            if ($stock < $newQty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more. Stock limit reached.'
                ], 400);
            }

            $existingCart->update(['product_quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $wish->product_id,
                'product_varient_id' => $wish->product_varient_id,
                'product_quantity' => $quantity,
                'ip_addresscart' => $request->ip(),
            ]);
        }

        // Remove from wishlist after moving to cart
        $wish->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item moved to cart successfully!'
        ]);
    }

    /**
     * Remove an item from the wishlist.
     */
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $wishId = $request->input('wishlist_id');
        $wish = Wishlist::find($wishId);

        if ($wish) {
            $wish->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from wishlist.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
    }

    /**
     * Update the quantity of a wishlist item with stock validation.
     */
    public function updateQuantity(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $wishId = $request->input('wishlist_id');
        $action = $request->input('action'); // 'increment' or 'decrement'
        $wish = Wishlist::find($wishId);

        if (!$wish) {
            return response()->json(['success' => false, 'message' => 'Item not found in wishlist.'], 404);
        }

        $newQty = $wish->product_quantity ?? 1;
        if ($action == 'increment') {
            $newQty++;
        } elseif ($action == 'decrement' && $newQty > 1) {
            $newQty--;
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid action or minimal quantity reached.']);
        }

        // Stock Validation
        if ($wish->product_varient_id) {
            $stock = ProductVarient::find($wish->product_varient_id)->product_qty;
        } else {
            $stock = Product::find($wish->product_id)->product_quantity;
        }

        if ($stock < $newQty) {
            return response()->json(['success' => false, 'message' => 'Stock limit reached.'], 400);
        }

        $wish->update(['product_quantity' => $newQty]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated.',
            'new_qty' => $newQty
        ]);
    }
}
