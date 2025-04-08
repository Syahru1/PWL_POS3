<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $role = ''): Response {
    //     $user = $request->user(); // ambil data user yang login
    //                               // fungsi user() diambil dari UserModel.php
    //     if ($user->hasRole($role)) { // Cek apakah user punya role yang diinginkan
    //         return $next($request);
    //     }

    //     // Jika tidak punya role, maka tampilkan error 403
    //     abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user_role = $request->user()?->getRole(); // ambil data level_kode dari user yg login
        if (in_array($user_role, $roles)) { // Cek apakah level_kode user ada di dalam array roles
            return $next($request);     // jika ada, lanjutkan request
        }
        // Jika tidak punya role, tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}