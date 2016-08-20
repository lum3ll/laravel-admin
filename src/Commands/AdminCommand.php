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
     * File stubs.
     *
     * @var array
     */
    protected $files = [
        '/resources/views/admin/auth/login.blade.php' => 'views/auth/login.stub',
        '/resources/views/admin/dashboard.blade.php' => 'views/dashboard.stub',
        '/database/migrations/created_admin_users_table.php' => 'migrations/create_admin_users_table.stub',
        '/app/Http/Controllers/AdminController.php' => 'controllers/AdminController.stub'
    ];

    /**
     * Fire the admin command.
     *
     * @return void
     */
    public function fire()
    {
        $this->createAdminDirectories();
        $this->turnStubsIntoFiles();
    }

    /**
     * Create any admin directories.
     *
     * @return void
     */
    private function createAdminDirectories()
    {
        if (!is_dir(base_path('resources/views/admin'))) {
            mkdir(base_path('resources/views/admin'));
        }
    }

    /**
     * Turn all stubs into files.
     *
     * @return void
     */
    private function turnStubsIntoFiles()
    {
        foreach ($this->views as $key => $value) {
            // Format a file location from the array of stubs
            // that need to be turned into views.
            $filename = base_path() . $key;

            // Create the view and then copy the contents of
            // the stub into the view.
            touch($filename);

            file_put_contents($filename, file_get_contents(__DIR__ . $value));
        }
    }
}