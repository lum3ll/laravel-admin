# Laravel Admin [![Build Status](https://travis-ci.org/jordanbardsley7/laravel-admin.svg)](https://travis-ci.org/jordanbardsley7/laravel-admin.svg)
Create a Laravel admin backend with a few simple commands.

### Register the service provider
First things first, you need to register the service provider to be able to use the artisan console command.
To do so add the following code into the providers array in `config/app.php` and you will be able to use 
the command.

```php
\LaravelAdmin\LaravelAdminServiceProvider::class
```

### Running the command
Once the service provider is added to the configuration, you will be able to run the admin up command. So all
you need to do is run `php artisan admin:up` and that will generate all the controllers, routes, views, etc.
for the admin backend.

### Configuration
Once you run the command you will have a configuration file in `config/admin.php`. Here you can set custom results pagination, the location of your admin model, etc. So make sure to compile your assets with gulp once the admin panel has been installed.

### Registering models (tables)
Once you have gone through the command to setup the admin backend, you will see a generated configuration file at
`config/admin.php`. That file contains the necessary configuration. To register models, you can add them to the
models array in the config file.

```php
'models' => [
    'users' => \App\User::class
],
```

### Screenshots
![Laravel Admin Demo](/screenshots/demo.png?raw=true)
![Laravel Admin Demo](/screenshots/demo2.png?raw=true)