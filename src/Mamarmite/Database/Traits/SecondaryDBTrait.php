<?php

namespace Mamarmite\Database\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait SecondaryDBTrait
{

    protected $primary_connection = 'database.data';
    protected $secondary_connection = 'database.ontology';
    protected $users_connection = 'database.data';

    protected $migration_connection;//set the migration connexion.

    protected function createTable($name, \Closure $callback, $connection = 'primary')
    {
        $connection = $this->migration_connection ?? $connection;
        Schema::connection($this->get_connection($connection))->create($name, $callback);
    }

    protected function dropIfExistsTable($name, $connection = 'primary')
    {
        $connection = $this->migration_connection ?? $connection;
        Schema::connection($this->get_connection($connection))->dropIfExists($name, $callback);
    }


    //v. 0.0.1
    protected function get_connection($connection) {
        switch($connection) {

            case "secondary":
                return config($this->secondary_connection);

            case "users":
                return config($this->users_connection);

            default:
            case "primary":
                return config($this->primary_connection);
        }
    }

}
