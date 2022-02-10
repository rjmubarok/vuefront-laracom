<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
Route::get('/category/{category}', [CategoryController::class, 'show']);
Route::get('/brands', [BrandController::class, 'index']);

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
    Route::post('brand',[BrandController::class,'store'])->middleware('permission:create-brand');
    Route::put('brand/{brand}',[BrandController::class,'update'])->middleware('permission:update-brand');
    Route::delete('brand/{brand}',[BrandController::class,'destroy'])->middleware('permission:delete-brand');
});