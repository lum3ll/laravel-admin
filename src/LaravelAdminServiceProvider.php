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
        $this->commands([ AdminCommand::class ]);
    }
}