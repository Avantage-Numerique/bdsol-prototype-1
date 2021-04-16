<?php

namespace App\Providers;

use App\Observers\Admin\SluggerObserver;
use Domain\Persons\Models\Person;
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
        //
        \Domain\Persons\Models\Person::observe(SluggerObserver::class);
    }
}
