<?php

namespace LaravelAdmin\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;

class AdminCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'admin:make';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Generate the laravel admin backend.';

    /**
     * Application directories.
     *
     * @var array
     */
    protected $directories = [
        '/resources/views/admin',
        '/resources/views/templates',
        '/resources/views/admin/auth'
    ];

    /**
     * File stubs.
     *
     * @var array
     */
    protected $files = [
        '/resources/views/templates/admin.blade.php' => 'views/templates/admin.stub',
        '/resources/views/admin/auth/login.blade.php' => 'views/auth/login.stub',
        '/resources/views/admin/dashboard.blade.php' => 'views/dashboard.stub',
        '/database/migrations/created_admin_users_table.php' => 'migrations/create_admin_users_table.stub',
        '/app/Http/Controllers/AdminController.php' => 'controllers/AdminAuthController.stub'
    ];

    /**
     * Routes stub.
     *
     * @var string
     */
    protected $routes = 'routes.stub';

    /**
     * Fire the admin command.
     *
     * @return void
     */
    public function fire()
    {
        // Create all necessary admin directories
        // before turning the stubs into files.
        $this->createAdminDirectories();

        // Turn any necessary laravel admin stubs
        // into files and create those files.
        $this->turnStubsIntoFiles();

        // Append any laravel admin routes to the
        // current application routes file.
        $this->appendRoutesStubToRoutes();

        $this->comment('Laravel admin has been installed, please run your migrations.');
    }

    /**
     * Create any admin directories.
     *
     * @return void
     */
    private function createAdminDirectories()
    {
        foreach ($this->directories as $directory) {
            if (!is_dir(base_path() . $directory)) {
                mkdir(base_path() . $directory);
            }
        }
    }

    /**
     * Turn all stubs into files.
     *
     * @return void
     */
    private function turnStubsIntoFiles()
    {
        foreach ($this->files as $key => $value) {
            // Format a file location from the array of stubs
            // that need to be turned into views/files.
            $filename = base_path() . $key;

            // Create the view and then copy the contents of
            // the stub into the view.
            touch($filename);

            file_put_contents($filename, $this->getStubContents($value));
        }
    }

    /**
     * Retrieve stub contents.
     *
     * @return mixed
     */
    private function getStubContents($file)
    {
        $contents = file_get_contents(__DIR__ . '/../stubs/' . $file);

        // return str_replace('{{ namespace }}', $this->getAppNamespace(), $contents);
        return str_replace('{{ namespace }}', 'App\\', $contents);
    }

    /**
     * Add admin routes.
     *
     * @return void
     */
    private function appendRoutesStubToRoutes()
    {
        if ($this->canReadRoutesFile())
        {
            // Retrieve the contents of the routes stub
            // before writing to the application routes.
            $contents = file_get_contents(__DIR__ . '/../stubs/' . $this->routes);

            // Append the contents of the routes stub
            // to the existing application routes.
            file_put_contents(base_path() . '/app/Http/routes.php', $contents,  FILE_APPEND);
        }
    }

    /**
     * If the routes file exists.
     *
     * @return boolean
     */
    private function canReadRoutesFile()
    {
        return file_exists(base_path() . '/app/Http/routes.php');
    }
}