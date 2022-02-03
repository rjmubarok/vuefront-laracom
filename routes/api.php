<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VandorController;
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
Route::get('/brands', [BrandController::class, 'index']);

/**** End Public Routes ****/

//Authentic routes
Route::middleware('auth:sanctum')->group(function () {

    //user routes
    Route::resource('/user', UserController::class)->middleware('permission:user-crud');

    //category routes
    Route::post('/add-category', [CategoryController::class, 'store']);
    // brand route
    
    Route::delete('/remove-brand/{id}',[BrandController::class,'destroy']);
    Route::post('/add-brand',[BrandController::class,'store']);
    Route::post('/add-vandor',[VandorController::class,'store']);
    Route::delete('/remove-vandor/{id}',[BrandController::class,'destroy']);

});


