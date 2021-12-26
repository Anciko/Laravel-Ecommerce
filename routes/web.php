<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'login');
Route::post('/', [UserController::class, 'login'])->name('user-login');

Route::group(['middleware' => 'auth', 'prefix' => "/admin"], function () {
    Route::get('/', fn () => view('admin.home'))->name('admin-home');
    Route::get('/logout', [UserController::class, 'logout'])->name('user-logout');
    Route::resource('categories', CategoryController::class);
    Route::resource('categories.subcats', SubCatController::class)->shallow();
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
});
