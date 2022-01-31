<?php

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
Route::get('category', [CategoryController::class, 'index']);

/**** End Public Routes ****/

//Authentic routes
Route::middleware('auth:sanctum')->group(function () {

    //user routes
    Route::get('/user', [UserController::class, 'index'])->middleware('permission:view-user');
    Route::put('/user/{user}', [UserController::class, 'update'])->middleware('permission:update-user');

    //category routes
    Route::post('category', [CategoryController::class, 'store'])->middleware('permission:add-category');
});
