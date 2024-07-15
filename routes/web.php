<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product_details');
Route::post('/getsize', [FrontendController::class, 'get_size']);
Route::post('/getquantity', [FrontendController::class, 'get_quantity']);


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


// Customer
Route::get('/customer/login', [CustomerAuthController::class,'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class,'customer_register'])->name('customer.register');
Route::post('/customer/store', [CustomerAuthController::class,'customer_store'])->name('customer.store');
Route::post('/customer/logged', [CustomerAuthController::class,'customer_logged'])->name('customer.logged');
