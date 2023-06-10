<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\CategoryController;

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
    Route::resource('category', CategoryController::class)->except('store','destroy','update','edit','show');
    Route::post('category/get-data', [CategoryController::class, 'getData'])->name('category.get-data');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('category/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Subcategory Route

    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::post('subcategory/get-data', [SubcategoryController::class, 'getData'])->name('subcategory.get-data');
    Route::post('subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::post('subcategory/edit', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::post('subcategory/categorySelect',[SubcategoryController::class, 'categorySelect'])->name('subcategory.categorySelect');

});

