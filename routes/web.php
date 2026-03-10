<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Customer\CustomerController;
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

// halaman register
Route::get('/register',[RegisterController::class,'index'])->name('register');

// proses register
Route::post('/register',[RegisterController::class,'store'])->name('register.store');

Route::get('/register/therapist', function () {
    return view('auth.register-therapist');
})->name('register.therapist');

Route::post('/register/therapist', [RegisterController::class, 'store'])
    ->name('register.therapist.store');

Route::get('/verify-email', function(){

    return view('auth.verify-email');

})->name('verify.notice');


Route::post('/verify-email',
    [RegisterController::class,'verifyOtp']
)->name('verify.process');

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
    ->name('finance.')
    ->group(function () {

        Route::get('/dashboard',[FinanceController::class,'dashboard'])->name('dashboard');
        
        Route::get('/dashboard-overview', [FinanceController::class,'overview'])->name('dashboard.overview');

        Route::prefix('transaction')->name('transaction.')->group(function(){

            Route::get('/transfer',[FinanceController::class,'transfer'])->name('transfer');

            Route::get('/cash',[FinanceController::class,'cash'])->name('cash');

            Route::get('/cancelled',[FinanceController::class,'cancelled'])->name('cancelled');

            Route::get('/reschedule',[FinanceController::class,'reschedule'])->name('reschedule');

        });

        Route::get('/transaction/{id}',[FinanceController::class,'detail'])->name('transaction.detail');

        Route::get('/recap',[FinanceController::class,'recap'])->name('recap');

        Route::get('/salary',[FinanceController::class,'salary'])->name('salary');

        Route::get('/setting',[FinanceController::class,'setting'])->name('setting');

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

        Route::get('/dashboard', [CustomerController::class, 'customer'])
            ->name('customer.dashboard');

        Route::get('/services', function () {
            return view('pages.customer.services');
        })->name('customer.services');

        Route::get('/cart', function () {
            return view('pages.customer.cart');
        })->name('customer.cart');

        Route::get('/orders', function () {
            return view('pages.customer.orders');
        })->name('customer.orders');

});