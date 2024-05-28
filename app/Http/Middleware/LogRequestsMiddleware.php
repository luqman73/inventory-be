<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\DB;

class LogRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = collect($request->headers->all())->mapWithKeys(function ($value, $key) {
            return [$key => $key === 'authorization' ? '[secret]' : $value];
        })->all();

        $clientName = 'Unauthorized';
       
        Log::channel('requests')->info('Request Logged:', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'params' => $request->all(),
            'headers' => $headers,
            'userId' => '',
            'client' => $clientName,
            'timestamp' => Carbon::now()->toDateTimeString()
        ]);
    return $next($request);
    }
}