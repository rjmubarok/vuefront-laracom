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
Route::get('/brands', [BrandController::class, 'index']);

/**** End Public Routes ****/

//Authentic routes
Route::middleware('auth:sanctum')->group(function () {

    //user routes
    Route::get('/user', function () {
        return User::all();
    });
    Route::put('/user/{user}', [UserController::class, 'update']);

    //category routes
    Route::post('/add-category', [CategoryController::class, 'store']);
    // brand route
    Route::post('/add-brand',[BrandController::class,'store']);
    Route::delete('/remove-brand/{id}',[BrandController::class,'destroy']);
});


