<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ExpirePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Check where the link is coming from
         */
        $referer = $request->header('referer');
        Log::warning('Referer: ', ['referer' => $referer]);

        if ($referer && strpos($referer, 'begin_survey') !== false)
        {
            Log::alert('Expired Page Detected');

            return response('Page Expired', Response::HTTP_GONE)->header('X-Page-Expired', 'true');
        }

        $response = $next($request);

        if ($response instanceof HttpResponse)
        {
            $response->header('X-Page-Expired', 'false');
        }
        elseif ($response instanceof Response) {
            $response->headers->set('X-Page-Expired', 'false');
        }

        return $response;
    }
}
