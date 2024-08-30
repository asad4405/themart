<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product_details');
Route::post('/getsize', [FrontendController::class, 'get_size']);
Route::post('/getquantity', [FrontendController::class, 'get_quantity']);
Route::get('/shop',[FrontendController::class,'shop'])->name('shop');
Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
Route::post('/contact/post',[FrontendController::class,'contact_post'])->name('contact.post');
Route::get('/recent/view',[FrontendController::class,'recent_view'])->name('recent.view');
Route::get('/faqs',[FrontendController::class,'faqs'])->name('faqs');


Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Banner
Route::get('/banner', [BannerController::class, 'banner'])->name('banner');
Route::post('/banner/store', [BannerController::class, 'banner_store'])->name('banner.store');
Route::get('/banner/delete/{banner_id}', [BannerController::class, 'banner_delete'])->name('banner.delete');

// user //
Route::get('/user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('/user.update.post', [UserController::class, 'user_update_post'])->name('user.update.post');
Route::post('/password/update', [UserController::class, 'password_update'])->name('password.update');
Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');

// User list
Route::get('/user/list', [HomeController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{user_id}', [HomeController::class, 'user_delete'])->name('user.delete');
Route::post('/user/add', [HomeController::class, 'user_add'])->name('user.add');

// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update/{category_id}', [CategoryController::class, 'category_update'])->name('category.update');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash', [CategoryController::class, 'category_trash'])->name('category.trash');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/permanent/delete/{category_id}', [CategoryController::class, 'category_permanent_delete'])->name('category.permanent.delete');
Route::post('/checked/delete', [CategoryController::class, 'checked_delete'])->name('checked.delete');
Route::post('/checked/restore', [CategoryController::class, 'checked_restore'])->name('checked.restore');

// Sub Category
Route::get('/subcategory', [SubCategoryController::class, 'sub_category'])->name('sub.category');
Route::post('/subcategory/store', [SubCategoryController::class, 'sub_category_store'])->name('sub.category.store');
Route::get('/subcategory/edit/{subcategory_id}', [SubCategoryController::class, 'sub_category_edit'])->name('sub.category.edit');
Route::post('/subcategory/update/{subcategory_id}', [SubCategoryController::class, 'sub_category_update'])->name('sub.category.update');
Route::get('/subcategory/delete/{subcategory_id}', [SubCategoryController::class, 'sub_category_delete'])->name('sub.category.delete');

// Brand
Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');

// Product
Route::get('/add/product', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/getsubcategory', [ProductController::class, 'get_subcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/show/{product_id}', [ProductController::class, 'product_show'])->name('product.show');

//  Variation
Route::get('/variation', [VariationController::class, 'variation'])->name('variation');
Route::post('/color/store', [VariationController::class, 'color_store'])->name('color.store');
Route::get('/color/delete/{color_id}', [VariationController::class, 'color_delete'])->name('color.delete');
Route::post('/size/store', [VariationController::class, 'size_store'])->name('size.store');
Route::get('/size/delete/{size_id}', [VariationController::class, 'size_delete'])->name('size.delete');

// Inventory
Route::get('/inventory/{product_id}', [InventoryController::class, 'add_inventory'])->name('add.inventory');
Route::post('/inventory/store/{product_id}', [InventoryController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{inventory_id}', [InventoryController::class, 'inventory_delete'])->name('inventory.delete');

// Offer
Route::get('/offer', [OfferController::class, 'offer'])->name('offer');
Route::post('/offer/one/update/{offer_one_id}', [OfferController::class, 'offer_one_update'])->name('offer.one.update');
Route::post('/offer/two/update/{offer_two_id}', [OfferController::class, 'offer_two_update'])->name('offer.two.update');

// Subscribe
Route::post('/subscribe/store', [FrontendController::class, 'subscribe_store'])->name('subscribe.store');
Route::get('/subscribe/list', [HomeController::class, 'subscribe_list'])->name('subscribe.list');
Route::get('/subscribe/delete/{subscribe_id}', [HomeController::class, 'subscribe_delete'])->name('subscribe.delete');

// tag
Route::get('/tag',[TagController::class,'tag'])->name('tag');
Route::post('/tag/store',[TagController::class,'tag_store'])->name('tag.store');
Route::get('/tag/delete/{id}',[TagController::class,'tag_delete'])->name('tag.delete');

// Customer
Route::get('/customer/login', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/store', [CustomerAuthController::class, 'customer_store'])->name('customer.store');
Route::post('/customer/logged', [CustomerAuthController::class, 'customer_logged'])->name('customer.logged');

Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
Route::get('/customer/logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');
Route::post('/customer/profile/update', [CustomerController::class, 'customer_profile_update'])->name('customer.profile.update');

Route::get('/customer/my/orders', [CustomerController::class, 'my_orders'])->name('my.orders');
Route::get('/download.invoice/{id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');
// customer email verify
Route::get('/customer/email/verify/{token}',[CustomerController::class, 'customer_email_verify'])->name('customer.email.verify');
Route::get('/resend/email/verify',[CustomerController::class, 'resend_email_verify'])->name('resend.email.verify');
Route::post('/resend/link/send',[CustomerController::class, 'resend_link_send'])->name('resend.link.send');

// captcha
Route::get('/reload-captcha', [CustomerAuthController::class, 'reloadCaptcha']);

// Cart
Route::post('/add/cart', [CartController::class, 'add_cart'])->name('add.cart')->middleware('customer.verified');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove')->middleware('customer.verified');
Route::get('/cart', [CartController::class, 'cart'])->name('cart')->middleware('customer.verified');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update')->middleware('customer.verified');

// Coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');
Route::get('/coupon/status/{coupon_id}', [CouponController::class, 'coupon_status'])->name('coupon.status');
Route::get('/coupon/delete/{coupon_id}', [CouponController::class, 'coupon_delete'])->name('coupon.delete');

// Checkout
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::post('/getcity', [CheckoutController::class, 'getcity']);

Route::post('/order/store', [CheckoutController::class, 'order_store'])->name('order.store');
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order.success');

// Orders
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
Route::post('/order/status/update/{id}', [OrderController::class, 'order_status_update'])->name('order.status.update');
Route::get('/cancel/order/{id}', [OrderController::class, 'cancel_order'])->name('cancel.order');
Route::post('/cancel/order/request/{id}', [OrderController::class, 'cancel_order_request'])->name('cancel.order.request');
Route::get('/order/cancel/list', [OrderController::class, 'order_cancel_list'])->name('order.cancel.list');
Route::get('/order/cancel/details/{id}', [OrderController::class, 'order_cancel_details'])->name('order.cancel.details');
Route::get('/order/cancel/accept/{id}', [OrderController::class, 'order_cancel_accept'])->name('order.cancel.accept');

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('/add/wishlist', [WishlistController::class, 'add_wishlist'])->name('add.wishlist');
Route::get('/delete/wishlist/{id}', [WishlistController::class, 'delete_wishlist'])->name('delete.wishlist');

// SSLCOMMERZ Start
Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslpay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Stripe Start
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// Stripe End

// Product Review
Route::post('/review/store/{product_id}', [FrontendController::class, 'review_store'])->name('review.store');


// Role Manager
Route::get('role/manager', [RoleController::class, 'role_manage'])->name('role.manage');
Route::post('permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::get('edit/role/{role_id}', [RoleController::class, 'edit_role'])->name('edit.role');
Route::post('update/role/{role_id}', [RoleController::class, 'update_role'])->name('update.role');
Route::get('delete/role/{role_id}', [RoleController::class, 'delete_role'])->name('delete.role');
Route::post('assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('remove/role/{id}', [RoleController::class, 'remove_role'])->name('remove.role');

// Forget password Customer
Route::get('/forgot/password',[PasswordResetController::class,'forgot_password'])->name('forgot.password');
Route::post('/password/reset/request',[PasswordResetController::class, 'password_reset_request'])->name('password.reset.request');
Route::get('/password/reset/form/{token}',[PasswordResetController::class, 'password_reset_form'])->name('password.reset.form');
Route::post('/password/reset/confirm/{token}',[PasswordResetController::class, 'password_reset_confirm'])->name('password.reset.confirm');

// FAQ
Route::resource('/faq',FaqController::class);

// Social Register & login
// google
Route::get('/google/redirect',[SocialiteController::class,'google_redirect'])->name('google.redirect');
Route::get('/google/callback',[SocialiteController::class,'google_callback'])->name('google.callback');

// github
Route::get('/github/redirect',[SocialiteController::class,'github_redirect'])->name('github.redirect');
Route::get('/github/callback',[SocialiteController::class,'github_callback'])->name('github.callback');






