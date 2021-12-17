<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
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
        // This logic would share categories across all pages using a view composer
        // When using Livewire, you would just have to pass the categories into the compoent with :categories="$categories" in the view
        // view()->composer('layouts.app', function ($view) {
        //     $view->with([
        //         'categories', Category::all()
        //     ]);
        // });

        // Create a blade directive to verify if user is admin
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }
}
