<?php
namespace App\Http\Middleware;
use Closure;
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
        $response = $next($request);
        // CORS
        if (env('CORS_ENABLE', false)) {
            $origin = array_key_exists('HTTP_ORIGIN', $_SERVER) ? $_SERVER['HTTP_ORIGIN'] : '*';
            $credentials = ($origin == '*') ? 'false' : 'true';
            $response->headers->set('Access-Control-Allow-Origin' , $origin);
            $response->headers->set('Access-Control-Allow-Credentials', $credentials);
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With');
        }
        // API content type
        $content_type = env('API_CONTENT_TYPE', false);

        if ($content_type)
            $response->headers->set('content-type', $content_type);
        $response->header('Content-Type', 'application/json');
        return $response;
    }
}