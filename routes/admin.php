<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Category;
use PHPUnit\Framework\Attributes\Group;

Auth::routes();

Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard')->middleware('is_admin');

Route::get('/admin',function(){
    return view('layouts.admin');
});

Route::prefix('admin/')->name('admin.')->middleware(['auth','is_admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'admin'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('logout');

    // Category route
    Route::resource('category', CategoryController::class)->except('store','destroy','update','edit');
    Route::post('category/get-data', [CategoryController::class, 'getData'])->name('category.get-data');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::post('category/edit', [CategoryController::class, 'edit'])->name('category.edit');

    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');

    Route::post('category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');



});

