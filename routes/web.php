<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\ServiceController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

// proses login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
/*
|--------------------------------------------------------------------------
| DASHBOARD SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:super_admin'])
    ->prefix('superadmin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'superadmin'])
            ->name('superadmin.dashboard');

        Route::get(
            '/services',
            [ServiceController::class, 'index']
        )->name('superadmin.services');

        Route::post(
            '/services',
            [ServiceController::class, 'store']
        )->name('superadmin.services.store');

        Route::put(
            '/services/{id}',
            [ServiceController::class, 'update']
        )->name('superadmin.services.update');

        Route::delete(
            '/services/{id}',
            [ServiceController::class, 'destroy']
        )->name('superadmin.services.destroy');

        Route::post(
            '/superadmin/additional-services',
            [ServiceController::class,'store']
        )->name('superadmin.additional-services.store');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD FINANCE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:finance'])
    ->prefix('finance')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'finance'])
            ->name('finance.dashboard');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD TERAPIS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:terapis'])
    ->prefix('terapis')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'terapis'])
            ->name('terapis.dashboard');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:customer'])
    ->prefix('customer')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'customer'])
            ->name('customer.dashboard');

});