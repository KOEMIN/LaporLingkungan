<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Cek apakah user sudah login DAN apakah dia seorang admin

    /** @var \App\Models\User|null $user */
    $user = Auth::user();

    if (Auth::check() && $user && $user->isAdmin()) {
        // Jika ya, izinkan lanjut
        return $next($request);
    }

    // Jika bukan admin, tendang kembali ke halaman utama
    return redirect()->route('home')->with('error', 'Anda tidak punya hak akses Admin!');
}
}
