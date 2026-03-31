<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; 
use App\Http\Controllers\Auth\TherapistAssessmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Finance\FinanceController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TherapistController;

/// Customer
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ServiceCustController;
use App\Http\Controllers\Customer\OrderController;

//Superadmin
use App\Http\Controllers\SuperAdmin\ServiceController as SuperAdminServiceController;
use App\Http\Controllers\SuperAdmin\CabangController;
use App\Http\Controllers\SuperAdmin\LandingPageController;
use App\Http\Controllers\SuperAdmin\LandingBenefitController;
use App\Http\Controllers\Superadmin\ServiceController;
use App\Http\Controllers\Superadmin\SuperadminController;

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

Route::get('/register/therapist', [RegisterController::class, 'index'])
    ->name('register.therapist');

Route::post('/register/therapist', [RegisterController::class, 'store'])
    ->name('register.therapist.store');

Route::get('/terapis/assessment', [TherapistAssessmentController::class, 'index'])
    ->name('therapist.assessment');

Route::post('/terapis/assessment', [TherapistAssessmentController::class, 'store'])
    ->name('terapis.assessment.store');

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

        Route::get('/dashboard', [SuperadminController::class, 'dashboard'])
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

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */
        Route::prefix('orders')->group(function () {

            Route::get('/status', [AdminOrderController::class, 'status'])->name('admin.orders.status');
            Route::get('/waiting', [AdminOrderController::class, 'waiting'])->name('admin.orders.waiting');
            Route::get('/finished', [AdminOrderController::class, 'finished'])->name('admin.orders.finished');
            Route::get('/reschedule', [AdminOrderController::class, 'reschedule'])->name('admin.orders.reschedule');

            Route::get('/{id}/detail', [AdminOrderController::class,'detail'])
                ->name('admin.orders.detail');

            Route::get('/{id}/edit', [AdminOrderController::class,'edit'])
                ->name('admin.orders.edit');

            Route::put('/{id}/update', [AdminOrderController::class,'update'])
                ->name('admin.orders.update');

            Route::delete('/{id}/delete', [AdminOrderController::class,'delete'])
                ->name('admin.orders.delete');

            Route::post('/{id}/approve', [AdminOrderController::class,'approve'])
                ->name('admin.orders.approve');

            Route::post('/{id}/reject', [AdminOrderController::class,'reject'])
                ->name('admin.orders.reject');
        });

        /*
        |--------------------------------------------------------------------------
        | THERAPIST
        |--------------------------------------------------------------------------
        */
        Route::prefix('therapist')->group(function () {

            // 🔹 AKUN (CRUD)
            Route::get('/', [TherapistController::class, 'index'])
                ->name('admin.therapist.index');

            Route::get('/create', [TherapistController::class, 'create'])
                ->name('admin.therapist.create');

            Route::post('/store', [TherapistController::class, 'store'])
                ->name('admin.therapist.store');

            Route::get('/{id}/edit', [TherapistController::class, 'edit'])
                ->name('admin.therapist.edit');

            Route::put('/{id}/update', [TherapistController::class, 'update'])
                ->name('admin.therapist.update');

            Route::delete('/{id}/delete', [TherapistController::class, 'destroy'])
                ->name('admin.therapist.delete');


            // 🔹 VERIFIKASI
            Route::get('/verification', [TherapistController::class, 'verification'])
                ->name('admin.therapist.verification');

            Route::post('/{id}/verify', [TherapistController::class, 'verify'])
                ->name('admin.therapist.verify');

            Route::post('/{id}/reject', [TherapistController::class, 'reject'])
                ->name('admin.therapist.reject');

            Route::get('/admin/therapist/{id}', [TherapistController::class, 'show'])
                ->name('admin.therapist.show'); 


            // 🔹 RATING & ULASAN
            Route::get('/review', [TherapistController::class, 'review'])
                ->name('admin.therapist.review');
        });

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

        Route::get('/dashboard', [TerapisController::class, 'dashboard'])
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

        Route::post('/cart/checkout', [CartController::class,'checkout'])
            ->name('customer.cart.checkout');


        /* ORDERS */
        Route::get('/orders', [OrderController::class,'index'])
            ->name('customer.orders');

        Route::get('/orders/{id}', [OrderController::class,'show'])
            ->name('customer.orders.show');

        Route::post('/orders/{id}/payment', [OrderController::class,'payment'])
            ->name('customer.orders.payment');

        Route::get('/payment/{id}', [OrderController::class,'paymentPage'])
            ->name('customer.payment');

        Route::post('/customer/orders/{id}/upload-payment', [OrderController::class, 'uploadPaymentProof'])
            ->name('customer.upload.payment');

        Route::get('/cart/count', function(){

            return response()->json([
                'count' => \App\Models\Cart::where('user_id', auth()->id())->sum('qty')
            ]);

        })->middleware('auth');

});