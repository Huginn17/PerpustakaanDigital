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
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user->role !== $role) {

            return match ($user->role) {
                'anggota' => redirect()->route('anggota.dashboard'),
                'petugas' => redirect()->route('petugasDashboard'),
                'kepala_perpustakaan' => redirect()->route('kepalaDashboard'),
                default => redirect('/login'),
            };
        }

        return $next($request);
    }
}
