<?php

namespace Mamarmite\Generators\Console\Commands;

use Mamarmite\Generators\Console\Commands\DomainGeneratorCommand;
use Illuminate\Support\Str;

class CrudModelBackpackCommand extends DomainGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'project:crud-model';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:crud-model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Backpack CRUD model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * The trait that allows a model to have an admin panel.
     *
     * @var string
     */
    protected $crudTrait = 'Backpack\CRUD\app\Models\Traits\CrudTrait';


    protected $file_end = '';
    protected $generator_path = 'Models';


    protected $change_name_to = true;
    protected $change_name_method = 'singular';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/crud-model.stub';
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceTable(&$stub, $name)
    {
        $name = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', str_replace($this->getNamespace($name).'\\', '', $name))), '_');

        $table = Str::snake($name);

        $stub = str_replace('DummyTable', $table, $stub);

        return $this;
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        if ($this->change_name_to) {
            $target_class = \Str::{$this->change_name_method}($name);
        } else {
            $target_class = $name;
        }

        return $this->replaceNamespace($stub, $name.'\Models\fullname')->replaceTable($stub, $name)->replaceClass($stub, $target_class);
    }

}
