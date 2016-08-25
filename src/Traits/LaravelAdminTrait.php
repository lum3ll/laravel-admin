<?php

namespace LaravelAdmin\Traits;

trait LaravelAdminTrait
{
    /**
     * @var array
     */
    private $directories = [
        '/resources/views/admin',
        '/resources/views/layouts',
        '/resources/views/admin/auth',
        '/app/Http/Controllers/Admin'
    ];

    /**
     * @var array
     */
    private $views = [
        '/resources/views/layouts/admin.blade.php' => 'views/templates/admin.stub',
        '/resources/views/admin/auth/login.blade.php' => 'views/auth/login.stub',
        '/resources/views/admin/dashboard.blade.php' => 'views/dashboard.stub',
        '/resources/views/admin/view.blade.php' => 'views/view.stub'
    ];

    /**
     * @var array
     */
    private $controllers = [
        '/app/Http/Controllers/Admin/AdminAuthController.php' => 'controllers/admin/AdminAuthController.stub',
        '/app/Http/Controllers/Admin/DashboardController.php' => 'controllers/admin/DashboardController.stub'
    ];

    /**
     * @var array
     */
    private $migrations = [
        '/database/migrations/create_admins_table.php' => 'migrations/create_admins_table.stub'
    ];

    /**
     * @var array
     */
    private $config = [
        '/config/admin.php' => 'config/admin.stub'
    ];

    /**
     * @var array
     */
    private $middleware = [
        '/app/Http/Middleware/AdminMiddleware.php' => 'middleware/AdminMiddleware.stub',
        '/app/Http/Middleware/AdminGuestMiddleware.php' => 'middleware/AdminGuestMiddleware.stub'
    ];

    /**
     * @var array
     */
    private $models = [
        '/app/Admin.php' => 'models/admin.stub'
    ];

    /**
     * Retrieve all directories.
     *
     * @return array
     */
    protected function directories()
    {
        return $this->directories;
    }

    /**
     * Retrieve all files.
     *
     * @return array
     */
    protected function files()
    {
        return array_merge(
            $this->views, 
            $this->controllers, 
            $this->migrations, 
            $this->config,
            $this->middleware,
            $this->models
        );
    }
}