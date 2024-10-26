<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class SubdomainSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();

        // Kiểm tra host để xác định subdomain
        if ($host === 'admin.localhost') {
            Config::set('session.domain', 'admin.localhost');
        } elseif ($host === 'student.localhost') {
            Config::set('session.domain', 'student.localhost');
        } elseif ($host === 'student1.localhost') {
            Config::set('session.domain', 'student1.localhost');
        } elseif ($host === 'student2.localhost') {
            Config::set('session.domain', 'student2.localhost');
        } else {
            Config::set('session.domain', 'localhost');
        }

        return $next($request);
    }
}
