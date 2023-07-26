<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\IndexController;




Auth::routes();


Route::get('/', [IndexController::class, 'index']);
Route::get('product/details/{slug}', [IndexController::class,'productDetails'])->name('product.details');
Route::get('customer/logout', [IndexController::class,'customerLogout'])->name('customer.logout');

Route::post('review', [IndexController::class,'review'])->name('review.store');
Route::get('quick/view', [IndexController::class,'quickView'])->name('quick.view');


// add to cart
Route::post('add-to-cart', [CartController::class,'addToCartQv'])->name('add.to.cart.quickview');
Route::get('cart', [CartController::class,'myCart'])->name('cart');
Route::post('cart/reload', [CartController::class,'cartReload'])->name('cart.reload');
Route::get('cart/empty', [CartController::class,'cartEmpty'])->name('cart.empty');
Route::post('cart/remove', [CartController::class,'cartRemove'])->name('cart.remove');
Route::post('cart-qty/update', [CartController::class,'cartUpdateQty'])->name('cart.qty.update');
Route::post('cart-color/update', [CartController::class,'cartUpdateColor'])->name('cart.color.update');
Route::post('cart-size/update', [CartController::class,'cartUpdateSize'])->name('cart.size.update');

// wishlist
Route::get('wishlist', [CartController::class,'wishlist'])->name('wishlist');
Route::get('add/wishlist/{product_id}', [CartController::class,'addWishlist'])->name('add.wishlist');
Route::get('empty/wishlist', [CartController::class,'emptyWishlist'])->name('empty.wishlist');
Route::get('remove/product/wishlist/{id}', [CartController::class,'WishlistProductRemove'])->name('remove.product.wishlist');


// Route::get('my-cart', [CartController::class,'myCart'])->name('cart');


// Route::get('category/product-show/{category}', [IndexController::class, 'categoryWiseProduct'])->name('category.product-show');
