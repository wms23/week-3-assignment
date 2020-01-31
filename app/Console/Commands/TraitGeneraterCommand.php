<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class TraitGeneraterCommand extends GeneratorCommand
{

    protected $name = 'make:trait';

    protected $description = 'Command description';

    protected $type = "Trait";

    protected function getStub()
    {
        return __DIR__ . '/stubs/traits.stub';
    }

    protected function getDefaultNamespace($rootNameSpace)
    {
        return $rootNameSpace . '\Traits';
    }

}
