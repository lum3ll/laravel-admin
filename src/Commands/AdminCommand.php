<?php

namespace LaravelAdmin\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Console\AppNamespaceDetectorTrait;

class AdminCommand extends GeneratorCommand
{
    use AppNamespaceDetectorTrait;

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'admin';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Generate the laravel admin backend.';

    /**
     * Fire the admin command.
     *
     * @return void
     */
    public function fire()
    {
        
    }
}