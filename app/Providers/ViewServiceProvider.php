<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Orders;
use Illuminate\Support\Facades\View;
use App\Models\MessageModel;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share the unread order count across all views
        View::share('newOrderCount', Orders::whereDate('created_at', now()->toDateString())
                                           ->where('is_read', false)
                                           ->count());
        
        // Share the unread message count across all views
        View::share('unreadMessageCount', MessageModel::where('is_read', false)->count());

         View::composer('*', function ($view) {
        $newCartCount = \App\Models\CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();
        $view->with('newCartCount', $newCartCount);
    });
    } 
}
