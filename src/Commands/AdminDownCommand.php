<?php

namespace LaravelAdmin\Commands;

use Illuminate\Console\Command;
use LaravelAdmin\Traits\LaravelAdminTrait;

class AdminDownCommand extends Command
{
    use LaravelAdminTrait;

    /**
     * @var string
     */
    protected $name = 'admin:down';

    /**
     * @var string
     */
    protected $description = 'Remove the laravel admin backend.';

    /**
     * Fire the command.
     *
     * @return void
     */
    public function fire()
    {
        // Loop over all generated admin files
        // and remove them from the tree.
        $this->unlinkFiles();

        // Loop over any generated admin directories
        // and remove them only if they are empty.
        $this->removeDirectories();

        $this->comment('The generated admin directories/files have been removed.');
    }

    /**
     * Unlink any previously generated admin files.
     *
     * @return void
     */
    private function unlinkFiles()
    {
        foreach ($this->files as $file => $stub) {
            unlink(base_path() . $file);
        }
    }

    /**
     * Remove admin directories.
     *
     * @return void
     */
    private function removeDirectories()
    {
        foreach (array_reverse($this->directories) as $directory) {
            // Scan the directories for any sub-directories/files
            // that may have been created by the developer.
            $scanned = scandir(base_path() . $directory);

            // Remove any system directories from the array
            // because they dont count!
            $files = array_filter($scanned, function ($file) {
                return ! in_array($file, ['.', '..']);
            });

            // Only remove the directory if
            // its any empty one!
            if (empty($files)) {
                rmdir(base_path() . $directory);
            }
        }
    }
}