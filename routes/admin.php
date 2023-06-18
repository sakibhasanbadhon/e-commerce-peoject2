<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Seo;

Auth::routes();

Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard')->middleware('is_admin');

// Route::get('/admin',function(){
//     return view('layouts.admin');
// });

Route::prefix('admin/')->name('admin.')->middleware(['auth','is_admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'admin'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('password/change', [AdminController::class, 'passwordChange'])->name('password.change');
    Route::post('password/update', [AdminController::class, 'passwordUpdate'])->name('password.update');


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
    Route::get('subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::post('subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');


    // Subcategory Route
    Route::get('childCategory', [ChildCategoryController::class, 'index'])->name('childCategory.index');
    Route::post('childCategory/get-data', [ChildCategoryController::class, 'getData'])->name('childCategory.get-data');
    Route::post('childCategory/store', [ChildCategoryController::class, 'store'])->name('childCategory.store');
    Route::get('childCategory/edit/{id}', [ChildCategoryController::class, 'edit'])->name('childCategory.edit');
    Route::put('childCategory/update/{id}', [ChildCategoryController::class, 'update'])->name('childCategory.update');
    Route::post('childCategory/destroy', [ChildCategoryController::class, 'destroy'])->name('childCategory.destroy');

    Route::get('subcategories/{categoryId}', [ChildCategoryController::class, 'getSubcategories'])->name('category_get');


    // Brand route
    Route::resource('brand', BrandController::class)->except('store','destroy','update','edit','show');
    Route::post('brand/get-data', [BrandController::class, 'getData'])->name('brand.get-data');
    Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::post('brand/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/destroy', [BrandController::class, 'destroy'])->name('brand.destroy');


    // setting route
    Route::get('setting/seo', [SettingController::class, 'seo'])->name('setting.seo');
    Route::post('setting/seo/update/{id}', [SettingController::class, 'seoUpdate'])->name('setting.seo.update');
    Route::get('setting/smtp', [SettingController::class, 'smtp'])->name('setting.smtp');
    Route::post('setting/smtp/update/{id}', [SettingController::class, 'smtpUpdate'])->name('setting.smtp.update');



});

