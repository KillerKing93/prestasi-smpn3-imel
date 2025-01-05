<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
    if (! $request->expectsJson()) {
        // Cek apakah pengguna adalah siswa atau petugas
        if (auth()->guard('siswa')->check()) {
            // Jika pengguna adalah siswa, arahkan ke halaman login siswa
            return route('siswa.login');
        } elseif (auth()->guard('petugas')->check()) {
            // Jika pengguna adalah petugas, arahkan ke halaman login petugas
            return route('petugas.login');
        }

        // Jika tidak ada autentikasi, arahkan ke login default (misalnya siswa)
        return route('siswa.login');
        }
    }

}
