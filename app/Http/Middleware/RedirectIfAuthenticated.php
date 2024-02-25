<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'administrator':
                        return redirect()->route('administrator.dashboard');
                    case 'doctor':
                        return redirect()->route('doctor.dashboard');
                    case 'patient':
                        return redirect()->route('patient.dashboard');
                    default:
                        // Optional: Redirect to a default page if no specific guard match
                }
            }
        }

        return $next($request);
    }
}
