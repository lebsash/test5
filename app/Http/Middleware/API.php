<?php
namespace App\Http\Middleware;
use Closure;
use Symfony\Component\HttpFoundation\HeaderBag;

class API
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$response = $next($request);

        
        // API content type
        $content_type = env('API_CONTENT_TYPE', false);

        if ($content_type) {
            
            $request->headers->set('Content-Type', $content_type);

        }
        
        $request->server->set('HTTP_ACCEPT', 'application/json');
        $request->headers->set('Accept', 'application/json');
        $request->headers = new HeaderBag($request->server->getHeaders());




        return $next($request);
        //return $response;
    }
}