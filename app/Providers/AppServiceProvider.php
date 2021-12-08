<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use Domain\Ontology\Models\OntologyClass;
use Domain\Ontology\Models\OntologyProperty;

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
        //Auto set slug on save.
        //OntologyClass::observe(SluggerObserver::class);
        //OntologyProperty::observe(SluggerObserver::class);
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
