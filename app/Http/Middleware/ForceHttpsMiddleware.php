<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttpsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika request tidak aman (bukan https) DAN aplikasi ada di produksi
        if (!$request->secure() && app()->environment('production')) {
            // Redirect ke URL yang sama tapi dengan skema https
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
