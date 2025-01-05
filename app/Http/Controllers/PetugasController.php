<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Lomba;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('cek_login:petugas')->except(['showLoginForm', 'login', 'logout']);
    }

    // ===========================
    // Authentication Section
    // ===========================
    public function showLoginForm()
    {
        return view('auth.petugas_login', [
            "title" => 'Login Petugas'
        ]);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('petugas')->attempt($credentials)) {
            return redirect()->intended('petugas/dashboard');
        }

        return redirect()->route('petugas.login')->withErrors('Username atau password salah');
    }

    public function logout()
    {
        Auth::guard('petugas')->logout();
        Session::flush();
        return redirect()->route('petugas.login');
    }

    // ===========================
    // Dashboard Section
    // ===========================
    public function index()
    {
        $data_lomba = Lomba::count();
        $data_prestasi = Prestasi::count();

        $lomba_jan = Lomba::whereMonth('tanggal' , '01')->count();
        $lomba_feb = Lomba::whereMonth('tanggal' , '02')->count();
        $lomba_maret = Lomba::whereMonth('tanggal' , '03')->count();
        $lomba_april = Lomba::whereMonth('tanggal' , '04')->count();
        $lomba_mei = Lomba::whereMonth('tanggal' , '05')->count();
        $lomba_juni = Lomba::whereMonth('tanggal' , '06')->count();
        $lomba_juli = Lomba::whereMonth('tanggal' , '07')->count();
        $lomba_agust = Lomba::whereMonth('tanggal' , '08')->count();
        $lomba_sep = Lomba::whereMonth('tanggal' , '09')->count();
        $lomba_okt = Lomba::whereMonth('tanggal' , '10')->count();
        $lomba_nov = Lomba::whereMonth('tanggal' , '11')->count();
        $lomba_des = Lomba::whereMonth('tanggal' , '12')->count();

        $prestasi_jan = Prestasi::whereMonth('tanggal' , '01')->count();
        $prestasi_feb = Prestasi::whereMonth('tanggal' , '02')->count();
        $prestasi_maret = Prestasi::whereMonth('tanggal' , '03')->count();
        $prestasi_april = Prestasi::whereMonth('tanggal' , '04')->count();
        $prestasi_mei = Prestasi::whereMonth('tanggal' , '05')->count();
        $prestasi_juni = Prestasi::whereMonth('tanggal' , '06')->count();
        $prestasi_juli = Prestasi::whereMonth('tanggal' , '07')->count();
        $prestasi_agust = Prestasi::whereMonth('tanggal' , '08')->count();
        $prestasi_sep = Prestasi::whereMonth('tanggal' , '09')->count();
        $prestasi_okt = Prestasi::whereMonth('tanggal' , '10')->count();
        $prestasi_nov = Prestasi::whereMonth('tanggal' , '11')->count();
        $prestasi_des = Prestasi::whereMonth('tanggal' , '12')->count();

        return view('petugas.dashboard', compact
        ([  
            'data_lomba','data_prestasi',
            'lomba_jan','lomba_feb','lomba_maret','lomba_april','lomba_mei','lomba_juni',
            'lomba_juli','lomba_agust','lomba_sep','lomba_okt','lomba_nov','lomba_des',
            'prestasi_jan','prestasi_feb','prestasi_maret','prestasi_april','prestasi_mei','prestasi_juni',
            'prestasi_juli','prestasi_agust','prestasi_sep','prestasi_okt','prestasi_nov','prestasi_des',

        ]),
        [
            "title" => 'Dasboard'
        ]);
    }

    // ===========================
    // Profil Section
    // ===========================
    public function profil($id_petugas)
    {
        $data = Auth::user();
        return view('petugas.profil', compact('data'), [
            "title" => 'Profil Petugas'
        ]);
    }

    public function update_profil(Request $request, $id_petugas)
    {
        $data = Petugas::findOrFail($id_petugas);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'profil' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('profil')) {
            if ($data->profil && File::exists($data->profil)) {
                File::delete($data->profil);
            }
            $namafile = $request->profil->getClientOriginalName();
            $request->profil->move('profil/', $namafile);
            $data->profil = 'profil/' . $namafile;
        }

        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->filled('password')) {
            $data->password = Hash::make($request->password);
        }

        $data->save();

        return redirect()->back()->with('sukses', 'Profil berhasil diperbarui');
    }

    // ===========================
    // Siswa Section
    // ===========================
    public function siswa()
    {
        // Mengambil data siswa dan mengurutkannya berdasarkan kelas (7, 8, 9)
        $siswa = Siswa::orderByRaw('FIELD(kelas, "7", "8", "9")')->get();

        return view('petugas.siswa', compact('siswa'), [
            "title" => 'Manajemen Siswa'
        ]);
    }
    public function add_siswa()
    {
        return view('petugas.add_siswa', [
            "title" => 'Tambah Siswa'
        ]);
    }

    public function create_siswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|unique:siswas',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas',
            'gender' => 'required',
            'username' => 'required|unique:siswas',
            'password' => 'required|min:6',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'gender' => $request->gender,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('petugas.siswa')->with('sukses', 'Siswa berhasil didaftarkan!');
    }

    public function edit_siswa($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        return view('petugas.edit_siswa', compact('siswa'))->with([
            "title" => 'Edit Siswa'
        ]);
    }

    public function update_siswa(Request $request, $nisn)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $siswa = Siswa::where('nisn', $nisn)->first();

        $siswa->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'gender' => $request->gender,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->filled('password') ? bcrypt($request->password) : $siswa->password,
        ]);

        return redirect()->route('petugas.siswa')->with('sukses', 'Data siswa berhasil diperbarui!');
    }

    public function delete_siswa($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        if ($siswa->profil && File::exists($siswa->profil)) {
            File::delete($siswa->profil);
        }
        $siswa->delete();

        return redirect()->route('petugas.siswa')->with('sukses', 'Siswa berhasil dihapus');
    }
}
