<?php

namespace Mamarmite\Generators;
//based heavily on Backpack\Generators;

use Mamarmite\Generators\Console\Commands\BuildBackpackCommand;
use Mamarmite\Generators\Console\Commands\ConfigBackpackCommand;
use Mamarmite\Generators\Console\Commands\CrudBackpackCommand;
use Mamarmite\Generators\Console\Commands\CrudControllerBackpackCommand;
use Mamarmite\Generators\Console\Commands\CrudModelBackpackCommand;
use Mamarmite\Generators\Console\Commands\CrudOperationBackpackCommand;
use Mamarmite\Generators\Console\Commands\CrudRequestBackpackCommand;
use Mamarmite\Generators\Console\Commands\ModelBackpackCommand;
use Mamarmite\Generators\Console\Commands\RequestBackpackCommand;
use Mamarmite\Generators\Console\Commands\ViewBackpackCommand;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $commands = [
        CrudModelBackpackCommand::class,
        CrudControllerBackpackCommand::class,
        CrudBackpackCommand::class,
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
