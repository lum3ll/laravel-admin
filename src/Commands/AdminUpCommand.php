<?php

namespace LaravelAdmin\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;
use LaravelAdmin\Traits\LaravelAdminTrait;
use LaravelAdmin\Exceptions\RoutesNotFoundException;

class AdminUpCommand extends Command
{
    use AppNamespaceDetectorTrait, LaravelAdminTrait;

    /**
     * @var string
     */
    protected $name = 'admin:up';

    /**
     * @var string
     */
    protected $description = 'Generate the laravel admin backend.';

    /**
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
     * @throws \LaravelAdmin\Exceptions\RoutesNotFoundException
     * @return void
     */
    private function appendRoutesStubToRoutes()
    {
        if (!$this->canReadRoutesFile()) {
            throw new RoutesNotFoundException('Could not locate routes file.');
        }

        // Retrieve the contents of the routes stub
        // before writing to the application routes.
        $contents = file_get_contents(__DIR__ . '/../stubs/' . $this->routes);

        // Append the contents of the routes stub
        // to the existing application routes.
        file_put_contents(base_path() . '/routes/web.php', $contents,  FILE_APPEND);
    }

    /**
     * If the routes file exists.
     *
     * @return boolean
     */
    private function canReadRoutesFile()
    {
        return file_exists(base_path() . '/routes/web.php');
    }
}