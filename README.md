# Laravel Admin
Create a Laravel admin backend with a few simple commands.

### Register the console command
First things first, you will need to register the artisan console command. So in ```app/Console/Kernel.php``` add this to the commands array.

```\LaravelAdmin\Commands\AdminCommand::class```