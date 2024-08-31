<?php

use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\CustomerAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Customer authenticaion //
Route::post('/customer/register', [CustomerAuthenticationController::class, 'customer_register']);
Route::post('/customer/login', [CustomerAuthenticationController::class, 'customer_login']);
Route::post('/customer/logout', [CustomerAuthenticationController::class, 'customer_logout']);


// Category
Route::get('/get/category', [CategoryApiController::class, 'get_category']);
Route::post('/category/store', [CategoryApiController::class, 'category_store']);
Route::get('/category/{id}/show', [CategoryApiController::class, 'category_show']);
Route::post('/category/{id}/update', [CategoryApiController::class, 'category_update']);
Route::delete('/category/{id}/delete', [CategoryApiController::class, 'category_delete']);
