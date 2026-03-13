<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Finance\FinanceController;

/// Customer
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\ServiceController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ServiceCustController;
use App\Http\Controllers\Customer\OrderController;

//Superadmin
use App\Http\Controllers\SuperAdmin\ServiceController as SuperAdminServiceController;
use App\Http\Controllers\SuperAdmin\CabangController;
use App\Http\Controllers\SuperAdmin\LandingPageController;
use App\Http\Controllers\SuperAdmin\LandingBenefitController;

// Terapis
use App\Http\Controllers\Terapis\TerapisController;

/*

|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/', [LandingPageController::class, 'showLanding']);


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

Route::get('/forgot-password', [ForgotPasswordController::class,'index']);
Route::post('/forgot-password/send', [ForgotPasswordController::class,'sendOtp'])->name('forgot.send');

Route::get('/forgot-password/verify', [ForgotPasswordController::class,'verifyPage']);
Route::post('/forgot-password/verify', [ForgotPasswordController::class,'verifyOtp'])->name('forgot.verify');

Route::get('/forgot-password/reset', [ForgotPasswordController::class,'resetPage']);
Route::post('/forgot-password/reset', [ForgotPasswordController::class,'resetPassword'])->name('forgot.reset');

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
            [SuperAdminServiceController::class, 'index']
        )->name('superadmin.services');

        Route::post(
            '/services',
            [SuperAdminServiceController::class, 'store']
        )->name('superadmin.services.store');

        Route::put(
            '/services/{id}',
            [SuperAdminServiceController::class, 'update']
        )->name('superadmin.services.update');

        Route::delete(
            '/services/{id}',
            [SuperAdminServiceController::class, 'destroy']
        )->name('superadmin.services.destroy');

        Route::post(
            '/superadmin/additional-services',
            [SuperAdminServiceController::class,'store']
        )->name('superadmin.additional-services.store');

        Route::get('/cabang',[CabangController::class,'index'])
             ->name('superadmin.cabang.index');

        Route::get('/cabang/create',[CabangController::class,'create'])
            ->name('superadmin.cabang.create');

        Route::post('/cabang/store',[CabangController::class,'store'])
            ->name('superadmin.cabang.store');

        Route::get('/superadmin/cabang/{id}', 
            [CabangController::class, 'show'])
            ->name('superadmin.cabang.show');

        Route::get('/cabang/{id}/edit',[CabangController::class,'edit'])
            ->name('superadmin.cabang.edit');

        Route::put('/cabang/{id}/update',[CabangController::class,'update'])
            ->name('superadmin.cabang.update');

        Route::delete('/cabang/{id}/delete',[CabangController::class,'destroy'])
            ->name('superadmin.cabang.delete');

        Route::get(
            '/landing-page',
            [LandingPageController::class,'index']
        )->name('superadmin.landing');

        Route::post(
            '/landing-page/update',
            [LandingPageController::class,'update']
        )->name('superadmin.landing.update');

        Route::get('/benefit/create', 
            [LandingPageController::class,'createBenefit']
        )->name('benefit.create');

        Route::post('/benefit/store', 
            [LandingPageController::class,'storeBenefit']
        )->name('benefit.store');

        Route::get('/benefit/edit/{id}', 
            [LandingPageController::class,'editBenefit']
        )->name('benefit.edit');

        Route::post('/benefit/update/{id}', 
            [LandingPageController::class,'updateBenefit']
        )->name('benefit.update');

        Route::delete('/benefit/delete/{id}', 
            [LandingPageController::class,'destroyBenefit']
        )->name('benefit.destroy');

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

        Route::get('/profile', [TerapisController::class, 'profile'])
            ->name('terapis.profile');

        Route::get('/profile/detail', [TerapisController::class, 'detail'])
            ->name('terapis.profile.detail');

        Route::post('/profile/update', [TerapisController::class, 'update'])
            ->name('terapis.profile.update');

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


        /* SERVICES */
        Route::get('/services', [ServiceCustController::class,'index'])
            ->name('customer.services');


        /* CART */
        Route::get('/cart', [CartController::class,'index'])
            ->name('customer.cart');

        Route::get('/cart/add/{id}', [CartController::class,'add'])
            ->name('customer.cart.add');

        Route::get('/cart/increase/{id}', [CartController::class,'increase'])
            ->name('customer.cart.increase');

        Route::get('/cart/decrease/{id}', [CartController::class,'decrease'])
            ->name('customer.cart.decrease');

        Route::get('/cart/remove/{id}', [CartController::class,'remove'])
            ->name('customer.cart.remove');


        /* ORDERS */
        Route::get('/orders', [OrderController::class,'index'])
            ->name('customer.orders');

        Route::get('/cart/count', function(){

            return response()->json([
                'count' => \App\Models\Cart::where('user_id', auth()->id())->sum('qty')
            ]);

        })->middleware('auth');

});