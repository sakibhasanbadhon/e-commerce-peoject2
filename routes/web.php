<?php

use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();


Route::get('/', [IndexController::class, 'index']);
Route::get('product/details/{slug}', [IndexController::class,'productDetails'])->name('product.details');
Route::get('customer/logout', [IndexController::class,'customerLogout'])->name('customer.logout');

Route::post('review', [IndexController::class,'review'])->name('review.store');
Route::get('add/wishlist/{product_id}', [IndexController::class,'wishlist'])->name('add.wishlist');
Route::get('quick/view', [IndexController::class,'quickView'])->name('quick.view');

Route::post('add-to-cart', [CartController::class,'addToCartQv'])->name('add.to.cart.quickview');

// Route::get('category/product-show/{category}', [IndexController::class, 'categoryWiseProduct'])->name('category.product-show');
