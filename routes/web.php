<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin', function () {
  return view('admin');
});

Route::get('admin/{any}', function () {
  return view('admin');
})->where('any', '.*');

Route::get('{any}', function () {
  return view('web');
})->where('any', '.*');

Auth::routes();
/*
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::redirect('/', 'admin/dashboard');
    Route::view('dashboard','admin.dashboard', ['page_title' => 'Dashboard'])->name('admin.dashboard');
    Route::view('category','admin.category', ['page_title' => 'Category'])->name('admin.category');
    Route::view('product','admin.product', ['page_title' => 'Product'])->name('admin.product');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category',function(){
    return view('category');
}); */
Route::post('/update-category', [CategoryController::class, 'update']);
Route::post('/categories/remove-items', [App\Http\Controllers\CategoryController::class, 'removeitem']);
Route::post('/categories/Change-Status-Active', [App\Http\Controllers\CategoryController::class, 'ChangeStatus']);