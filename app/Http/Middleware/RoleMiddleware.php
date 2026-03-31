<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->anggota) {
                return redirect()->route('anggota.dashboard');
            } elseif ($user->petugas) {
                return redirect()->route('petugas.dashboard');
            } elseif ($user->kepala_perpustakaan) {
            return redirect()->route('kepala-perpustakaan.dashboard');
            }
        }

        return $next($request);
    }
}
