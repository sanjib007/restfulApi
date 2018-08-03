<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $headerName = 'X-Name')
    {
        $responce = $next($request);
        $responce->headers->set($headerName, config('app.name'));
        return $responce;
    }
}
