<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CacheRequests
{
    public function handle($request, Closure $next)
    {
        if (in_array($request->getMethod(), ['PUT', 'POST', 'DELETE'])) {
            $response = $next($request);
            $entity = $this->getEntityRequest($request->route()->action['as']);
            $cacheKey = $this->generateCacheKey($entity . ".index");
            Redis::del($cacheKey);
            return $response;
        }

        // check if the Cache-Control header contains public
        if ($request->headers->has('Cache-Control') && str_contains($request->header('Cache-Control'), 'public')) {
            $response = $next($request);
            $cacheKey = $this->generateCacheKey($request->route()->action['as']);

            Redis::set($cacheKey, $response->getContent());
            Redis::expire($cacheKey, 300);

            return $response;
        }
        return $next($request);
    }

    // generate a unique key to request
    private function generateCacheKey($request): string
    {
        return 'response_' . md5($request);
    }

    // get request entity
    public function getEntityRequest(string $input): string
    {
        $parts = explode('.', $input);
        return $parts[0];
    }
}
