<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'home');

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::redirect('/', 'admin/dashboard');
    Route::view('dashboard','admin.dashboard', ['page_title' => 'Dashboard'])->name('admin.dashboard');
    Route::view('category','admin.category', ['page_title' => 'Category'])->name('admin.category');
    Route::view('product','admin.product', ['page_title' => 'Product'])->name('admin.product');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category',function(){
    return view('category');
});