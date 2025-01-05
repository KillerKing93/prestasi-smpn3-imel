<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_Login
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Validasi role berdasarkan guard
        switch ($role) {
            case 'siswa':
                if (!Auth::guard('siswa')->check()) {
                    return redirect()->route('siswa.login')->with('error', 'Harap login sebagai siswa.');
                }
                break;

            case 'petugas':
                if (!Auth::guard('petugas')->check()) {
                    return redirect()->route('petugas.login')->with('error', 'Harap login sebagai petugas.');
                }
                break;

            case null:
                if (!Auth::check()) {
                    return redirect()->route('login')->with('error', 'Harap login.');
                }
                break;

            default:
                abort(403, 'Role tidak valid atau akses ditolak.');
        }

        return $next($request);
    }
}
