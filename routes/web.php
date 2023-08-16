<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/loginStore', 'store');
    });
});

Route::middleware(['IsManager'])->group(function () {
    Route::controller(ManagerController::class)->group(function () {
        Route::get('/dashboard/manager', 'index');
        Route::post('/dashboard/manager/logout', 'logout')->name('manager-logout');
        Route::get('/dashboard/manager/activity', 'activity')->name('manager-activity');
    });
    Route::resource('/dashboard/manager/categoryProduct', CategoryProductController::class);
    Route::resource('/dashboard/manager/products', ProductsController::class);
});
