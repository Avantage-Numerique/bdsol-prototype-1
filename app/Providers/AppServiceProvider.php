<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Domain\Occupations\Models\Occupation;
use Domain\Persons\Models\Person;
use Domain\Uri\Observers\SluggerObserver;

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
    }
}
