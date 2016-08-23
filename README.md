# Laravel Admin
Create a Laravel admin backend with a few simple commands.

### Register the service provider
First things first, you need to register the service provider to be able to use the artisan console command.
To do so add the following code into the providers array in `config/app.php` and you will be able to use 
the command.

```php
\LaravelAdmin\LaravelAdminServiceProvider::class
```

### Running the command
Once the service provider is added to the configuration, you will be able to run the admin make command. So all
you need to do is run `php artisan admin:make` and that will generate all the controllers, routes, views, etc...
for the admin backend.