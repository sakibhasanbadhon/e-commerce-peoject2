<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\ProfileController;

Auth::routes();


Route::get('/', [IndexController::class, 'index']);
Route::get('product/details/{slug}', [IndexController::class,'productDetails'])->name('product.details');
Route::get('customer/logout', [IndexController::class,'customerLogout'])->name('customer.logout');

// this route for product details page review
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

// checkout
Route::get('product/checkout', [CheckoutController::class, 'checkout'])->name('product.checkout');
Route::post('apply/coupon', [CheckoutController::class,'applyCoupon'])->name('apply.coupon');
Route::get('remove/coupon', [CheckoutController::class,'removeCoupon'])->name('remove.coupon');
Route::post('order/place', [CheckoutController::class,'orderPlace'])->name('order.place');

// wishlist
Route::get('wishlist', [CartController::class,'wishlist'])->name('wishlist');
Route::get('add/wishlist/{product_id}', [CartController::class,'addWishlist'])->name('add.wishlist');
Route::get('empty/wishlist', [CartController::class,'emptyWishlist'])->name('empty.wishlist');
Route::get('remove/product/wishlist/{id}', [CartController::class,'WishlistProductRemove'])->name('remove.product.wishlist');


// category wise product

Route::get('categorywise/product/{id}', [IndexController::class, 'categoryWiseProduct'])->name('categorywise.product');
Route::get('subcategorywise/product/{id}', [IndexController::class, 'subcategoryWiseProduct'])->name('subcategorywise.product');
Route::get('childcategorywise/product/{id}', [IndexController::class, 'childcategoryWiseProduct'])->name('childcategorywise.product');
Route::get('brandwise/product/{id}', [IndexController::class, 'brandWiseProduct'])->name('brandwise.product');

// customer
// this route for website
Route::get('write/review', [IndexController::class,'writeReview'])->name('write.review');
Route::post('write/review/store', [IndexController::class,'writeReviewStore'])->name('write.review.store');

Route::get('profile/setting', [ProfileController::class,'profileSetting'])->name('profile.setting');
Route::post('profile/password/update', [ProfileController::class,'passwordChange'])->name('customer.password.change');
Route::post('profile/shipping.store', [ProfileController::class,'shippingStore'])->name('shipping.store');




// newsletter
Route::post('newsletter', [IndexController::class, 'newsletter'])->name('newsletter');

// footer view page
Route::get('footer/view/page/{page_slug}', [IndexController::class, 'footerViewPage'])->name('footer.view.page');


