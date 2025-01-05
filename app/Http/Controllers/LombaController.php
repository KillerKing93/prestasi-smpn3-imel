<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Lomba;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class LombaController extends Controller
{
    // Route Petugas
    public function lomba()
    {
        $lomba = Lomba::all();
        return view('petugas.lomba', compact(['lomba']), [
            "title" => 'Manajemen Lomba'
        ]);
    }

    public function petugas_add_lomba()
    {
        $siswa = Siswa::select('nisn', 'nama')->get();
        return view('petugas.add_lomba', [
            "title" => 'Manajemen Lomba',
            "siswa" => $siswa
        ]);
    }

    public function petugas_create_lomba(Request $request)
    {
    $validasi = $request->validate([
        'nama' => 'required',
        'nisn' => 'required',
        'kelas' => 'required',
        'lomba' => 'required',
        'penyelenggara' => 'required',
        'tingkat' => 'required',
        'date' => 'required|date',
        'sertifikat'  => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
    ]);

    // Proses upload file sertifikat
    $originalName = $request->file('sertifikat')->getClientOriginalName();
    $namaFile = time() . '_' . preg_replace('/\s+/', '_', $originalName);
    $request->file('sertifikat')->move(public_path('sertifikat'), $namaFile);

    // Membuat data lomba dengan status default 'ditolak' (0)
    Lomba::create([
        'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'lomba' => $request->lomba,
        'penyelenggara' => $request->penyelenggara,
        'tingkat' => $request->tingkat,
        'tanggal' => $request->date,
        'sertifikat' => $namaFile, // Simpan hanya nama file
    ]);

    return redirect()->route('lomba')->with('sukses', 'Lomba Berhasil Didaftarkan');
    }

    public function petugas_edit_lomba($id_lomba)
    {
        $lomba = Lomba::findOrFail($id_lomba);
        return view('petugas.edit_lomba', compact(['lomba']), [
            "title" => 'Manajemen Lomba'
        ]);
    }

    public function petugas_update_lomba(Request $request, $id_lomba)
    {
        $lomba = Lomba::find($id_lomba);
        $namafile = $lomba->sertifikat; // Default: tetap gunakan nama file lama jika tidak ada file baru

        // Periksa apakah ada file sertifikat baru yang diunggah
        if ($request->hasFile('sertifikat')) {
            // Hapus file lama jika ada
            if (file_exists(public_path('sertifikat/' . $lomba->sertifikat))) {
                File::delete(public_path('sertifikat/' . $lomba->sertifikat));
            }

            // Proses upload file sertifikat baru
            $originalName = $request->file('sertifikat')->getClientOriginalName();
            $namafile = time() . '_' . preg_replace('/\s+/', '_', $originalName);
            $request->file('sertifikat')->move(public_path('sertifikat'), $namafile);
        }

        // Update data lomba
        $cek = [
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'lomba' => $request->lomba,
            'penyelenggara' => $request->penyelenggara,
            'tingkat' => $request->tingkat,
            'tanggal' => $request->date,
            'sertifikat' => $namafile, // Update nama file baru jika ada
        ];

        $lomba->update($cek);

        return redirect()->route('lomba')->with('sukses', 'Data Berhasil Diedit');
    }
    public function petugas_delete_lomba($id_lomba)
    {
        $lomba = Lomba::findOrFail($id_lomba);

        // Cek dan hapus data prestasi yang terkait
        $kejuaraan = Prestasi::where('lomba', $lomba->lomba)
                             ->where('nama', $lomba->nama)
                             ->first();
        if ($kejuaraan) {
            $kejuaraan->delete();
        }

        // Hapus file sertifikat
        if (file_exists(public_path($lomba->sertifikat))) {
            File::delete(public_path($lomba->sertifikat));
        }

        $lomba->delete();

        return redirect()->route('lomba')->with('sukses', 'Data Berhasil Dihapus');
    }
    // End Route Petugas

    // =======================
    // Fungsi Lomba Siswa
    // =======================

    public function siswa_lomba()
    {
        $userName = Auth::guard('siswa')->user()->nama;
        $lomba = Lomba::where("nama", 'like', "%" . $userName . "%")->get();

        return view('siswa.lomba', compact('lomba'), [
            "title" => 'Manajemen Lomba'
        ]);
    }

    public function daftarkan_lomba()
    {
        return view('siswa.add_lomba', [
            "title" => 'Manajemen Lomba'
        ]);
    }
    // Route Siswa 
    public function siswa_create_lomba(Request $request)
    {
        // Validasi input
        $validasi = $request->validate([
            'lomba' => 'required',
            'penyelenggara' => 'required',
            'tingkat' => 'required',
            'date' => 'required|date',
            'sertifikat' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'kelas' => 'required',
        ]);

        // Ambil informasi siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // Membuat nama file unik untuk sertifikat
        $originalName = $request->file('sertifikat')->getClientOriginalName();
        $namaFile = time() . '_' . preg_replace('/\s+/', '_', $siswa->nama . '_' . $originalName);

        // Pindahkan file sertifikat ke folder public/sertifikat
        $request->file('sertifikat')->move(public_path('sertifikat'), $namaFile);

        // Simpan data lomba ke database
        Lomba::create([
            'id_petugas' => null, // Tidak ada petugas, null6
            'nama' => $siswa->nama,
            'nisn' => $siswa->nisn,
            'kelas' => $request->kelas,
            'lomba' => $request->lomba,
            'penyelenggara' => $request->penyelenggara,
            'tingkat' => $request->tingkat,
            'tanggal' => $request->date,
            'sertifikat' => $namaFile, // Hanya nama file disimpan
        ]);

        return redirect()->route('siswa.lomba')->with('sukses', 'Lomba berhasil didaftarkan.');
    }
    public function siswa_edit_lomba($id_lomba)
    {
        $lomba = Lomba::findOrFail($id_lomba);
        return view('siswa.edit_lomba', compact(['lomba']), [
            "title" => 'Edit Lomba'
        ]);
    }
    public function siswa_update_lomba(Request $request, $id_lomba)
    {
        $lomba = Lomba::findOrFail($id_lomba); // Pastikan data lomba valid

        // Validasi input
        $validasi = $request->validate([
            'lomba' => 'required',
            'penyelenggara' => 'required',
            'tingkat' => 'required',
            'date' => 'required|date',
            'sertifikat' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048', 
        ]);

        // Ambil data siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // Cek jika ada file baru yang diunggah
        if ($request->hasFile('sertifikat')) {
            // Hapus file sertifikat lama jika ada
            if (file_exists(public_path('sertifikat/' . $lomba->sertifikat))) {
                File::delete(public_path('sertifikat/' . $lomba->sertifikat));
            }
            // Membuat nama file baru
            $originalName = $request->file('sertifikat')->getClientOriginalName();
            $namaFile = time() . '_' . preg_replace('/\s+/', '_', $siswa->nama . '_' . $originalName);
            // Pindahkan file baru ke folder public/sertifikat
            $request->file('sertifikat')->move(public_path('sertifikat'), $namaFile);
            // Update nama file sertifikat di database
            $lomba->sertifikat = $namaFile;
        }
        // Update data lomba lainnya
        $lomba->update([
            'lomba' => $request->lomba,
            'penyelenggara' => $request->penyelenggara,
            'tingkat' => $request->tingkat,
            'tanggal' => $request->date,
            'sertifikat' => $lomba->sertifikat, // Tetap gunakan sertifikat baru jika ada
        ]);

        return redirect()->route('siswa.lomba')->with('sukses', 'Lomba berhasil diperbarui.');
    }

    public function siswa_delete_lomba($id_lomba)
    {
        // Debug: Log ID Lomba dan User Info
        Log::info('ID Lomba:', ['id_lomba' => $id_lomba]);
        // Mendapatkan data siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        if (!$siswa) {
            return redirect()->route('siswa.login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        // Debug: Log siswa info
        Log::info('Siswa:', ['username' => $siswa->username]);
        // Mengambil data lomba berdasarkan id_lomba dan nisn siswa
        $lomba = Lomba::where('id_lomba', $id_lomba)
                    ->where('nisn', $siswa->nisn) // Gunakan nisn untuk pencarian
                    ->first();
        // Debug: Log hasil query
        Log::info('Lomba Data:', ['lomba' => $lomba]);
        // Validasi apakah data lomba ditemukan
        if (!$lomba) {
            return redirect()->route('siswa.lomba')->with('error', 'Data lomba tidak ditemukan atau Anda tidak memiliki akses.');
        }
        // Debug: Log sebelum menghapus lomba
        Log::info('Menghapus lomba dengan ID:', ['id_lomba' => $lomba->id_lomba]);
        // Hapus data lomba
        $lomba->delete();
        // Debug: Log setelah menghapus lomba
        Log::info('Lomba berhasil dihapus', ['id_lomba' => $lomba->id_lomba]);

        return redirect()->route('siswa.lomba')->with('sukses', 'Lomba berhasil dihapus.');
    }
    // End Route Siswa
}
