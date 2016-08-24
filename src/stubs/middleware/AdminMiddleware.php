<?php

namespace {{ namespace }}Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware extends Middleware
{
    /**
     * Administration middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guest()) {
            return $request->redirect()->route('admin.login');
        }

        $admin = new {$this->getAdminModel()};

        if ($admin->hasPrivelages()) {
            return $next($request);
        }

        return $request->redirect()->route('admin.login');
    }

    /**
     * Retrieve the admin models namespace from config.
     *
     * @return string
     */
    private function getAdminModel()
    {
        return config('admin.lcoation');
    }
}