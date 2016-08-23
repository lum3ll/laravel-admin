<?php

namespace LaravelAdmin\Traits;

trait LaravelAdminTrait
{
    /**
     * @var array
     */
    protected $directories = [
        '/resources/views/admin',
        '/resources/views/templates',
        '/resources/views/admin/auth',
        '/app/Http/Controllers/Admin'
    ];

    /**
     * @var array
     */
    protected $files = [
        '/config/admin.php' => 'config/admin.stub',
        '/resources/views/layouts/admin.blade.php' => 'views/templates/admin.stub',
        '/resources/views/admin/auth/login.blade.php' => 'views/auth/login.stub',
        '/resources/views/admin/dashboard.blade.php' => 'views/dashboard.stub',
        '/database/migrations/created_admin_users_table.php' => 'migrations/create_admin_users_table.stub',
        '/app/Http/Controllers/Admin/AuthController.php' => 'controllers/admin/AuthController.stub',
        '/app/Http/Controllers/Admin/DashboardController.php' => 'controllers/admin/DashboardController.stub'
    ];
}