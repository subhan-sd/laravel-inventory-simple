<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (!app()->runningInConsole()) {
            \Illuminate\Support\Facades\View::composer('layouts.app', function ($view) {
                if (auth()->check()) {
                    $lowStockProducts = \App\Models\Product::where('stock', '<', 10)->latest()->get();
                    $view->with('notifications', $lowStockProducts);
                }
            });
        }
    }
}
