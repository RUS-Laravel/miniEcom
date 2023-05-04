<?php

namespace App\Providers;

use App\Models\Category;
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
        $this->app->singleton('categories', function () {
            return Category::with('categories')->whereNull('parent_id')->get();
        });

        $this->app->singleton('cat_counts', function () {
            return (Category::whereNotNull('parent_id')->activeproduct()->withCount('products')->get()->filter(function ($item) {
                return $item->products()->count() ? $item : null;
            })->values());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
