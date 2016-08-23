<?php

namespace LaravelAdmin;

use LaravelAdmin\Commands\AdminCommand;
use Illuminate\Support\ServiceProvider;

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
            AdminCommand::class
        ];
    }
}