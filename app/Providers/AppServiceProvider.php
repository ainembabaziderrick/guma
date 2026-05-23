<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Debtors;
use App\Models\Candidate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.master', function ($view) {
            $view->with('setting', Setting::first());
        });
        view()->composer('layouts.auth', function ($view) {
            $view->with('setting', Setting::first());
        });
        view()->composer('auth.login', function ($view) {
            $view->with('setting', Setting::first());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
  public function boot()
{
    View::composer('*', function ($view) {
        // existing cart count
        $cart = session()->get('cart', []);
        $cart_count = array_sum(array_column($cart, 'quantity'));

        // new pending debtors count
        $pendingDebtorsCount = Debtors::where('status', 'pending')->count();

        // share both with all views
        $view->with('cart_count', $cart_count)
             ->with('pendingDebtorsCount', $pendingDebtorsCount);

        View::composer('*', function ($view) {
        $view->with('pendingCandidatesCount', Candidate::pending()->count());
    });
    });
}


}
