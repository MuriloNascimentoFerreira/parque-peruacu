<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        $urls = 'Primeira url:'.$request->fullUrl().' segunda:'.route('visitas.create');
        \Log::info($urls);

        if(!Auth::check() && $request->fullUrl() == route('visitas.create')){
            return route('magic-register');
        }

        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
