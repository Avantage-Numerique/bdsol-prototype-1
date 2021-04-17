<?php

namespace Mamarmite\Generators\Console\Commands;

use Mamarmite\Generators\Console\Commands\DomainGeneratorCommand;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CrudControllerBackpackCommand extends DomainGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'project:crud-controller';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:crud-controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Backpack CRUD controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';


    protected $file_end = 'CrudController';
    protected $generator_path = 'Admin/Controllers';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/crud-controller.stub';
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceNameStrings(&$stub, $name)
    {
        $name_plural = Str::plural(ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', str_replace($this->getNamespace($name).'\\', '', $name))), '_'));
        $name_singular = Str::singular($name_plural);

        $table = $name_plural;
        $stub = str_replace('DummyTable', $table, $stub);
        $stub = str_replace('DummyDomainNamespace', $name, $stub);
        $stub = str_replace('dummy_class', strtolower(str_replace($this->getNamespace($name).'\\', '', $name)), $stub);

        $stub = str_replace('entity_singular', $name_singular, $stub);
        $stub = str_replace('entity_plural', $name_plural, $stub);

        return $this;
    }

    protected function getAttributes($model)
    {
        $attributes = [];
        $model = new $model;

        // if fillable was defined, use that as the attributes
        if (count($model->getFillable())) {
            $attributes = $model->getFillable();
        } else {
            // otherwise, if guarded is used, just pick up the columns straight from the bd table
            $attributes = \Schema::getColumnListing($model->getTable());
        }

        return $attributes;
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceSetFromDb(&$stub, $name)
    {
        $class = Str::afterLast($name, '\\');
        $model = $name."\\Models\\$class";

        if (! class_exists($model)) {
            return $this;
        }

        $attributes = $this->getAttributes($model);

        // create an array with the needed code for defining fields
        $fields = Arr::except($attributes, ['id', 'created_at', 'updated_at', 'deleted_at']);
        $fields = collect($fields)
            ->map(function ($field) {
                return "CRUD::field('$field');";
            })
            ->toArray();

        // create an array with the needed code for defining columns
        $columns = Arr::except($attributes, ['id']);
        $columns = collect($columns)
            ->map(function ($column) {
                return "CRUD::column('$column');";
            })
            ->toArray();

        // replace setFromDb with actual fields and columns
        $stub = str_replace('CRUD::setFromDb(); // fields', implode(PHP_EOL.'        ', $fields), $stub);
        $stub = str_replace('CRUD::setFromDb(); // columns', implode(PHP_EOL.'        ', $columns), $stub);

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     *
     * @return string
     */
    protected function replaceModel(&$stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $stub = str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);

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

        $this->replaceNamespace($stub, $name.'\Admin\Controllers\fullname')
            ->replaceNameStrings($stub, $name)
            ->replaceModel($stub, Str::singular($name))
            ->replaceSetFromDb($stub, $name);

        return $stub;
    }
}
