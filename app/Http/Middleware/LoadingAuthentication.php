<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoadingAuthentication
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
        if ($request->token != '$2y$10$dBMhFxTUppQRfnFnSLKJ/.rXIn8j1LbRtLt6NJAHaPaIh1oy7uiQC')
            return response()->json([
                'message'   =>  'شما به این بخش دسترسی ندارید'
            ], '403');

        return $next($request);
    }
}
