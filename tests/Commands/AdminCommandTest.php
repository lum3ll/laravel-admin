<?php

use Illuminate\Container\Container;
use LaravelAdmin\Commands\AdminUpCommand;
use LaravelAdmin\Commands\AdminDownCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

function base_path() {
    return dirname(__DIR__) . '/../output';
}

class AdminCommandTest extends PHPUnit_Framework_TestCase
{
    public function testAdminUpCommand()
    {
        $this->makeAnyNeededDirectoriesOrFiles();

        $app = new Application;
        $app->add(new AdminUpCommand);

        $command = $app->find('admin:up');
        $command->setLaravel(new Container);

        $tester = new CommandTester($command);
        $tester->execute([ 'command' => $command->getName() ]);

        $this->assertSame(trim($tester->getDisplay()), 'Laravel admin has been installed, please run your migrations.');
    }

    public function testAdminDownCommand()
    {
        $app = new Application;
        $app->add(new AdminDownCommand);

        $command = $app->find('admin:down');
        $command->setLaravel(new Container);

        $tester = new CommandTester($command);
        $tester->execute([ 'command' => $command->getName() ]);

        $this->assertSame(trim($tester->getDisplay()), 'The generated admin directories/files have been removed.');

        exec('rm -R output/');
    }

    private function makeAnyNeededDirectoriesOrFiles()
    {
        mkdir('output');
        mkdir('output/app');
        mkdir('output/app/Http');
        mkdir('output/app/Http/Middleware');
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