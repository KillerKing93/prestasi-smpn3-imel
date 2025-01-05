<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Login Petugas
    public function login_petugas()
    {
        return view('auth.login_petugas');
    }

    public function proses_login_petugas(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari petugas berdasarkan username
        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas && Hash::check($request->password, $petugas->password)) {
            // Jika petugas ditemukan dan password cocok
            Auth::guard('petugas')->login($petugas);

            // Login berhasil, arahkan ke dashboard
            return redirect()->route('petugas.dashboard');
        }

        // Jika username atau password salah
        return redirect()->route('petugas.login')->with('error', 'Username atau password salah.');
    }
    // Login Siswa
    public function login_siswa()
    {
        return view('auth.login_siswa');
    }

    public function proses_login_siswa(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari siswa berdasarkan username
        $user = Siswa::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika user ditemukan dan password cocok
            Auth::guard('siswa')->login($user);

            // Login berhasil, arahkan ke dashboard
            return redirect()->route('siswa.dashboard');
        }

        // Jika username atau password salah
        return redirect()->route('siswa.login')->with('error', 'Username atau password salah.');
    }
    // Logout Petugas
    public function logout_petugas(Request $request)
    {
        Auth::guard('petugas')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('petugas.login')->with('success', 'Logout berhasil.');
    }

    // Logout Siswa
    public function logout_siswa(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('siswa.login')->with('success', 'Logout berhasil.');
    }

    // Register Siswa
    public function showRegisterForm()
    {
        return view('auth.siswa_register');
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn|numeric',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'username' => 'required|unique:siswa,username|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profil')) {
            $profilPath = $request->file('profil')->store('public/profil');
        } else {
            $profilPath = null;
        }

        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'gender' => $request->gender,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profil' => $profilPath,
        ]);
        $siswa = Siswa::where('nisn', $request->nisn)->get();

        return redirect()->route('siswa.login')->with('sukses', 'Pendaftaran berhasil. Silakan login.');
    }
}
