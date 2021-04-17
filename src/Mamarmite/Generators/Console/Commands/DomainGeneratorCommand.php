<?php

namespace Mamarmite\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class DomainGeneratorCommand extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $generator_path = 'Admin/Controllers';

    protected $file_end = '';

    protected $change_name_to = false;
    protected $change_name_method = 'singular';

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $init_name = $name;
        $name = str_replace('Domain', '', $name);

        if ($this->change_name_to)
        {
            $target_name = str_replace('Domain', '', \Str::{$this->change_name_method}($name));
        }
        else
        {
            $target_name = str_replace('Domain', '', $name);
        }
        $filepath = 'src/' . str_replace('\\', '/', $init_name) . '/'.$this->generator_path . str_replace('\\', '/', $target_name).$this->file_end.'.php';

        return $filepath;
    }


    protected function getStub()
    {
        //must be overriden.
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Domain';
    }
}
