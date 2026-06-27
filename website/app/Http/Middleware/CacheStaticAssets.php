<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheStaticAssets
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Add cache headers for asset requests that go through Laravel
        $uri = $request->getRequestUri();
        if (preg_match('/\.(?:css|js|jpe?g|png|gif|svg|webp|woff2?|ttf|ico)$/i', $uri)) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
        }
        
        return $response;
    }
}
