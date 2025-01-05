<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Lomba;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('cek_login:siswa')->except(['showRegisterForm', 'proses_register', 'showLoginForm', 'login']);
    }

    // =======================
    // Fungsi Autentikasi
    // =======================

    // Form login siswa
    public function showLoginForm()
    {
        return view('auth.siswa_login', [
            "title" => 'Login Siswa'
        ]);
    }

    // Proses login siswa
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Siswa::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('siswa')->login($user);
            return redirect()->route('siswa.dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    // Proses logout siswa
    public function logout()
    {
        Auth::guard('siswa')->logout();
        return redirect()->route('siswa.login')->with('sukses', 'Berhasil logout.');
    }

    // =======================
    // Fungsi Registrasi
    // =======================

    // Form registrasi siswa
    public function showRegisterForm()
    {
        return view('auth.siswa_register', [
            "title" => 'Registrasi Siswa'
        ]);
    }

    // Proses registrasi siswa
    public function proses_register(Request $request)
    {
        $validasi = $request->validate([
            'nisn' => 'required|digits:10|unique:siswas,nisn', 
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',
            'gender' => 'required|string',
            'username' => 'required|string|max:255|unique:siswas,username',
            'password' => 'required|string|min:6',
            'kelas' => 'required|string',
            'profil' => 'nullable|mimes:jpg,png,jpeg|max:1024',
        ]);

        $request['password'] = Hash::make($request->password);
        $request['profil'] = $this->uploadFile($request, 'profil', 'profil');
        Siswa::create($request->all());

        return redirect()->route('siswa.login')->with('sukses', 'Registrasi berhasil, silakan login!');
    }

    // =======================
    // Fungsi Siswa
    // =======================

    // Dashboard siswa
    public function index()
    {
        if (Auth::guard('siswa')->check()) {
            $title = 'Dashboard Siswa';  
            return view('siswa.dashboard', compact('title'));
        }

        return redirect()->route('siswa.login')->with('error', 'Harap login untuk mengakses dashboard.');
    }

    // Profil siswa
    public function profil($nisn)
    {
        $data = Siswa::where('nisn', $nisn)->firstOrFail();
        return view('siswa.profil', compact('data'), [
            "title" => 'Profil'
        ]);
    }

    // Update profil siswa
    public function update_profil(Request $request, $nisn)
    {
        $data = Siswa::findOrFail($nisn);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $data->nisn . ',nisn',
            'gender' => 'required|string',
            'username' => 'required|string|max:255|unique:siswas,username,' . $data->nisn . ',nisn',
            'password' => 'nullable|string|min:6',
            'profil' => 'nullable|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($data->profil && $request->hasFile('profil')) {
            File::delete(public_path($data->profil));
        }

        $data->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'gender' => $request->gender,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $data->password,
            'profil' => $this->uploadFile($request, 'profil', 'profil') ?? $data->profil,
        ]);

        return redirect()->back()->with('sukses', 'Profil berhasil diperbarui!');
    }

    // =======================
    // Fungsi Utilitas
    // =======================

    protected function uploadFile(Request $request, $key, $folder)
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($folder), $filename);
            return "$folder/$filename";
        }
        return null;
    }
}
