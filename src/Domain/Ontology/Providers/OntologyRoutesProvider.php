<?php
namespace Domain\Ontology\Providers;

use Illuminate\Support\ServiceProvider;

class OntologyRoutesProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . './../Routes/Api.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

}
