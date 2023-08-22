<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;

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

Route::middleware(['IsCashier'])->group(function () {
    Route::controller(CashierController::class)->group(function () {
        Route::get('/dashboard/cashier', 'index');
        Route::get('/dashboard/cashier/cart', 'cart');
        Route::get('/dashboard/cashier/addToCart/{product:id}', 'addToCart');
        Route::get('/dashboard/cashier/deleteCart/{product:id}', 'deleteCart');
        Route::get('/dashboard/cashier/search', 'searchProduct')->name('cashier-searchProduct');
        Route::get('/dashboard/cashier/addTransaction', 'addTransaction')->name('cashier-addTransaction');
        Route::post('/dashboard/cashier/logout', 'logout')->name('cashier-logout');
    });
});
