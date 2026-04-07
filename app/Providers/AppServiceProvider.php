<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Transaction;
use App\Observers\TransactionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $cartCount = 0;

            if (Auth::check()) {

                $cartCount = Cart::where('user_id', Auth::id())->sum('qty');

            }

            $view->with('cartCount', $cartCount);

        });

        Transaction::observe(TransactionObserver::class);

    }
}
