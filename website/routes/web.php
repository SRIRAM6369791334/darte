<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/shop', function () {
//     return view('pages.shop');
// });
// Route::get('/shop-details', function () {
//     return view('pages.shop-details');
// });
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place')->middleware('auth');
Route::post('/prepare-payment', [OrderController::class, 'preparePayment'])->name('payment.prepare')->middleware('auth');
Route::post('/get-shipping-charge', [OrderController::class, 'getShippingCharge'])->name('get-shipping-charge')->middleware('auth');
Route::post('/get-cities-by-state', [OrderController::class, 'getCitiesByState'])->name('get-cities-by-state')->middleware('auth');
Route::post('/get-couriers', [OrderController::class, 'getShiprocketCouriers'])->name('get-couriers')->middleware('auth');
Route::post('/apply-coupon', [OrderController::class, 'applyCoupon'])->name('apply-coupon')->middleware('auth');
Route::get('/thank-you', function () {
    return view('pages.thankyou');
})->name('thankyou')->middleware('auth');
// Route::get('/blog', function () {
//     return view('pages.blog');
// });

/* LIST PAGE */
Route::get('/blog', [BlogController::class, 'index'])->name('blog.list');

/* DETAILS PAGE */
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.details');

Route::get('/registration', function () {
    return view('pages.registration');
});
Route::get('/my-account', function () {
    return view('pages.my-account');
})->name('login');
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
// Route::get('/blog-details', function () {
//     return view('pages.blog-details');
// });
Route::middleware('auth')->group(function () {
    Route::get('/account-profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/account-profile/update', [AccountController::class, 'updateProfile'])->name('account.profile.update');

    Route::get('/account-address', [AccountController::class, 'address'])->name('account.address');
    Route::post('/account-address/update', [AccountController::class, 'updateAddress'])->name('account.address.update');

    Route::get('/account-orders', [OrderController::class, 'accountOrders'])->name('account.orders');
    Route::get('/account-orders/{id}', [OrderController::class, 'accountOrderDetails'])->name('account.order.details');
    Route::get('/account-orders/{id}/cancel', [OrderController::class, 'accountOrderCancel'])->name('account.order.cancel');
    Route::post('/account-orders/{id}/cancel', [OrderController::class, 'accountOrderCancelSubmit'])->name('account.order.cancel.submit');
    Route::get('/account-orders/{id}/return', [OrderController::class, 'accountOrderReturn'])->name('account.order.return');
    Route::post('/account-orders/{id}/return', [OrderController::class, 'accountOrderReturnSubmit'])->name('account.order.return.submit');
});



// use App\Http\Controllers\AuthController;

// // Route::post('/register-user', [AuthController::class, 'register'])->name('register.user');
// Route::post('/register-user', [AuthController::class, 'register'])->name('register.user');
// Route::post('/login-user', [AuthController::class, 'login'])->name('login.user');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/login-user', [AuthController::class, 'login'])->name('login.user');

Route::post('/register-user', [AuthController::class, 'register'])->name('register.user');
Route::post('/login-user', [AuthController::class, 'login'])->name('login.user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::post('/send-otp', [AuthController::class, 'sendOtp']);
// Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
// Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


// Route::post('/contact_form', [ContactController::class, 'conduct_form'])
//     ->name('contact_form');
Route::post('/contact-form', [ContactController::class, 'submitForm'])
    ->name('contact.submit');



// routes/web.php
// Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{categorySlug}', [ProductController::class, 'index'])->name('shop.category');

Route::get('/shop-details/{slug}', [ProductController::class, 'show'])->name('shop.details');

// Cart & Wishlist AJAX Routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update')->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/cart/remove-all', [CartController::class, 'removeAll'])->name('cart.remove-all')->middleware('auth');
Route::post('/cart/update-size', [CartController::class, 'updateSize'])->name('cart.update-size')->middleware('auth');
Route::get('/cart/counts', [CartController::class, 'getCounts'])->name('cart.counts');

Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add')->middleware('auth');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove')->middleware('auth');
Route::post('/wishlist/update', [WishlistController::class, 'updateQuantity'])->name('wishlist.update-qty')->middleware('auth');

Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move')->middleware('auth');

Route::post('/product/review', [ProductController::class, 'storeReview'])->name('product.review.store')->middleware('auth');

// Policy Pages
Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacy.policy');
Route::get('/terms-conditions', function () {
    return view('pages.terms-conditions');
})->name('terms.conditions');
Route::get('/shipping-refund-policy', function () {
    return view('pages.cookies-policy');
})->name('shipping-refund-policy');
Route::get('/tracking-order', function () {
    return view('pages.tracking-returns');
})->name('tracking.order');
Route::get('/return-order', function () {
    return view('pages.tracking-returns');
})->name('return.order');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Sitemap
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);
