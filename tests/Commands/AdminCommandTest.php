<?php

use Illuminate\Container\Container;
use LaravelAdmin\Commands\AdminCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class AdminCommandTest extends PHPUnit_Framework_TestCase
{
    public function testAdminMakeCommand()
    {
        // create any directories/files for the tests
        // in the root of the project.
        $this->makeAnyNeededDirectoriesOrFiles();

        // Create a "mock" base_path helper function
        // similar to laravels base_path helper.
        function base_path() {
            return dirname(__DIR__) . '/../output';
        }

        // Setup a new symfony console
        // application instance.
        $app = new Application;
        $app->add(new AdminCommand);

        // Retrieve the command from the application
        // and then setup a new contianer.
        $command = $app->find('admin:make');
        $command->setLaravel(new Container);

        // Create a new command tester instance
        // and run the command.
        $tester = new CommandTester($command);
        $tester->execute([ 'command' => $command->getName() ]);

        // When the test is finished running
        // remove the output directories.
        exec('rm -R output/');

        $this->assertSame(trim($tester->getDisplay()), 'Laravel admin has been installed, please run your migrations.');
    }

    private function makeAnyNeededDirectoriesOrFiles()
    {
        mkdir('output');
        mkdir('output/app');
        mkdir('output/app/Http');
        mkdir('output/app/Http/Controllers');
        
        mkdir('output/routes');
        touch('output/routes/web.php');

        mkdir('output/resources');
        mkdir('output/resources/views');
        mkdir('output/resources/views/layouts');
        
        mkdir('output/config');
        mkdir('output/database');
        mkdir('output/database/migrations');
    }
}