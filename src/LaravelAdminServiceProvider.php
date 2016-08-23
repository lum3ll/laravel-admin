<?php

namespace LaravelAdmin;

use Illuminate\Support\ServiceProvider;
use LaravelAdmin\Commands\AdminUpCommand;

class LaravelAdminServiceProvider extends ServiceProvider
{
    /**
     * Register the command.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->getCommands());
    }

    /**
     * Any commands that need to be registered.
     *
     * @return array
     */
    private function getCommands()
    {
        return [
            AdminUpCommand::class
        ];
    }
}