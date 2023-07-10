<?php

use App\Http\Controllers\Website\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();


Route::get('/', [IndexController::class, 'index']);
Route::get('product/details/{slug}', [IndexController::class,'productDetails'])->name('product.details');
