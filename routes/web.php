<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserManagementController;

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
        Route::get('/dashboard/manager/transactionHistory', 'transactionHistory')->name('manager-transactionHistory');
        Route::get('/dashboard/manager/transactionHistorySearch', 'transactionSearch')->name('manager-transactionSearch');
        Route::get('/dashboard/manager/transactionHistoryFilter', 'transactionFilter')->name('manager-transactionFilter');
        Route::get('/dashboard/manager/transactionHistoryFilterDate', 'transactionFilterDate')->name('manager-transactionFilterDate');
        Route::resource('/dashboard/manager/categoryProduct', CategoryProductController::class);
        Route::resource('/dashboard/manager/products', ProductsController::class);
    });
});

Route::middleware(['IsAdmin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard/admin', 'index');
        Route::post('/dashboard/admin/logout','logout')->name('admin-logout');
        Route::get('/dashboard/activity','activity')->name('admin-activity');
    });
    Route::resource('/dashboard/admin/userManagement', AdminUserManagementController::class);
});
