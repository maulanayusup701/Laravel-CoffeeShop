<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index']);
    Route::post('/dashboard/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');
    Route::resource('/dashboard/admin/userManagement', AdminUserManagementController::class);
    Route::get('/dashboard/activity', [AdminController::class, 'activity'])->name('admin-activity');
});
