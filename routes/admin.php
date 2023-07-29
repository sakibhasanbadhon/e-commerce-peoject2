<?php

use App\Models\Seo;
use App\Models\Category;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Website\IndexController;

Auth::routes();

Auth::routes([
    // 'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...

  ]);

// Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('login');

Route::get('signup', [LoginController::class, 'signup'])->name('signup');
Route::post('signup/store', [LoginController::class, 'signupStore'])->name('signup.store');

Route::get('customer/dashboard', [IndexController::class, 'customer'])->name('customer.dashboard');

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
    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');


    // Subcategory Route
    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::post('subcategory/get-data', [SubcategoryController::class, 'getData'])->name('subcategory.get-data');
    Route::post('subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::get('subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('subcategory/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    Route::post('subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');


    // Child Category Route
    Route::get('childCategory', [ChildCategoryController::class, 'index'])->name('childCategory.index');
    Route::post('childCategory/get-data', [ChildCategoryController::class, 'getData'])->name('childCategory.get-data');
    Route::post('childCategory/store', [ChildCategoryController::class, 'store'])->name('childCategory.store');
    Route::post('childCategory/edit', [ChildCategoryController::class, 'edit'])->name('childCategory.edit');
    Route::post('childCategory/update/', [ChildCategoryController::class, 'update'])->name('childCategory.update');
    Route::post('childCategory/destroy', [ChildCategoryController::class, 'destroy'])->name('childCategory.destroy');

    Route::get('subcategories/{categoryId}', [ChildCategoryController::class, 'getSubcategories'])->name('category_get');


    // Brand route
    Route::resource('brand', BrandController::class)->except('store','destroy','update','edit','show');
    Route::post('brand/get-data', [BrandController::class, 'getData'])->name('brand.get-data');
    Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::post('brand/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/update', [BrandController::class, 'update'])->name('brand.update');
    Route::post('brand/destroy', [BrandController::class, 'destroy'])->name('brand.destroy');


    // setting route
    Route::get('setting/seo', [SettingController::class, 'seo'])->name('setting.seo');
    Route::put('setting/seo/update/{id}', [SettingController::class, 'seoUpdate'])->name('setting.seo.update');
    Route::get('setting/smtp', [SettingController::class, 'smtp'])->name('setting.smtp');
    Route::put('setting/smtp/update/{id}', [SettingController::class, 'smtpUpdate'])->name('setting.smtp.update');

    // website setting route
    Route::get('setting/website', [SettingController::class, 'website'])->name('setting.website');
    Route::put('setting/update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.update');

    // page route
    Route::get('page', [PageController::class, 'index'])->name('page.index');
    Route::get('page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('page/store', [PageController::class, 'store'])->name('page.store');
    Route::get('page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::put('page/update/{id}', [PageController::class, 'update'])->name('page.update');
    Route::delete('page/destroy/{id}', [PageController::class, 'destroy'])->name('page.destroy');

    // warehouse route
    Route::get('warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::post('warehouse/get-data', [WarehouseController::class, 'getData'])->name('warehouse.get-data');
    Route::post('warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::post('warehouse/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::post('warehouse/destroy', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');

    // Coupon route
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');
    Route::post('coupon/get-data', [CouponController::class, 'getData'])->name('coupon.get-data');
    Route::post('coupon/store', [CouponController::class, 'store'])->name('coupon.store');
    Route::post('coupon/edit', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::post('coupon/destroy', [CouponController::class, 'destroy'])->name('coupon.destroy');

    // Campaign route
    Route::get('campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::post('campaign/get-data', [CampaignController::class, 'getData'])->name('campaign.get-data');
    Route::post('campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
    Route::post('campaign/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::post('campaign/update', [CampaignController::class, 'update'])->name('campaign.update');
    Route::post('campaign/destroy', [CampaignController::class, 'destroy'])->name('campaign.destroy');



    // pickup Point route
    Route::get('pickup-Point', [PickupPointController::class, 'index'])->name('pickupPoint.index');
    Route::post('pickup-Point/get-data', [PickupPointController::class, 'getData'])->name('pickupPoint.get-data');
    Route::post('pickup-Point/store', [PickupPointController::class, 'store'])->name('pickupPoint.store');
    Route::post('pickup-Point/edit', [PickupPointController::class, 'edit'])->name('pickupPoint.edit');
    Route::post('pickup-Point/destroy', [PickupPointController::class, 'destroy'])->name('pickupPoint.destroy');


    // Product route
    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::post('product/get-data', [ProductController::class, 'getData'])->name('product.get-data');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('product/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('product/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('product/childcategory', [ProductController::class, 'childCatSelect'])->name('product.childCat');
    // Route::post('product/edit-childCat', [ProductController::class, 'editChildCatSelect'])->name('product.editChildCat');

    // Featured switch
    Route::post('product/featured_active', [ProductController::class, 'featuredActive'])->name('product.featured_active');
    Route::post('product/featured_deactivate', [ProductController::class, 'featuredDeactivate'])->name('product.featured_deactivate');

    // Today_deal switch
    Route::post('product/today_deal_active', [ProductController::class, 'today_deal_active'])->name('product.today_deal_active');
    Route::post('product/today_deal_deactivate', [ProductController::class, 'today_deal_deactivate'])->name('product.today_deal_deactivate');

    // Today_deal switch
    Route::post('product/status_active', [ProductController::class, 'status_active'])->name('product.status_active');
    Route::post('product/status_deactivate', [ProductController::class, 'status_deactivate'])->name('product.status_deactivate');




});

