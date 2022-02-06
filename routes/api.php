<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VandorController;
use App\Http\Controllers\VendorController;
use App\Models\Order;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/**** Start Public Routes ****/

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);

/**** End Public Routes ****/

//Authentic routes
Route::middleware('auth:sanctum')->group(function () {

 //user routes
 Route::resource('/user', UserController::class)->middleware('permission:user-crud');

 //category routes
 Route::post('category', [CategoryController::class, 'store'])->middleware('permission:create-category');
 Route::put('category/{category}', [CategoryController::class, 'update'])->middleware('permission:update-category');
 Route::delete('category/{category}', [CategoryController::class, 'destroy'])->middleware('permission:delete-category');
 //brand routes
 Route::post('brand', [BrandController::class, 'store'])->middleware('permission:create-brand');
 Route::put('brand/{brand}', [BrandController::class, 'update'])->middleware('permission:update-brand');
 Route::delete('brand/{brand}', [BrandController::class, 'destroy'])->middleware('permission:delete-brand');
 // vendor route
 Route::post('vendor', [VendorController::class, 'store'])->middleware('permission:create-vendor');
 Route::put('vendor/{vendor}',[VendorController::class,'update'])->middleware('permission:update-vendor');
 Route::delete('vendor/{vendor}', [VendorController::class, 'destroy'])->Middleware('permission:delete-vendor');
 // order route
 Route::post('order', [OrderController::class, 'store'])->middleware('permission:create-order');
 Route::put('order/{order}',[OrderController::class,'update'])->middleware('permission:update-order');
 Route::delete('order/{order}', [OrderController::class, 'destroy'])->Middleware('permission:delete-order');
  // product
Route::post('order', [ProductController::class, 'store'])->middleware('permission:create-product');
 Route::put('order/{order}',[ProductController::class,'update'])->middleware('permission:update-product');
 Route::delete('order/{order}', [ProductController::class, 'destroy'])->Middleware('permission:delete-produc');

});

 

