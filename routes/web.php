<?php

use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();


Route::get('/', [IndexController::class, 'index']);
Route::get('product/details/{slug}', [IndexController::class,'productDetails'])->name('product.details');
Route::get('customer/logout', [IndexController::class,'customerLogout'])->name('customer.logout');

Route::post('review', [IndexController::class,'review'])->name('review.store');
