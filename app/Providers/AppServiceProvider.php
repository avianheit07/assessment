<?php

namespace App\Providers;

use App\Models\Store;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (session()->has('selected_store')) {
                $store           = Store::find(session('selected_store'));
                $backgroundColor = $store ? $store->brand->color : '#FFFFFF';
                $textColor       = getContrastingColor($backgroundColor);

                $view->with('selectedStore', $store)
                    ->with('storeBackgroundColor', $backgroundColor)
                    ->with('storeTextColor', $textColor);
            }
        });
    }
}
