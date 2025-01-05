<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Lomba;
use App\Models\Siswa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PrestasiController extends Controller
{
    // Route Petugas
    public function index()
    {  
        $kejuaraan = Prestasi::sortable()->get();
        return view('petugas.prestasi', compact(['kejuaraan']) , [
            "title" => 'Manajemen Prestasi'
        ]);
    }

    public function petugas_add_prestasi()
    {
        // Ambil data NISN dan nama dari tabel Siswa
        $siswa = Siswa::select('nisn', 'nama')->get();

        // Kirim data siswa ke view
        return view('petugas.add_prestasi', [
            "title" => 'Manajemen Prestasi',
            "siswa" => $siswa
        ]);
    }

    public function petugas_create_prestasi(Request $request)
{
    // Validasi input
    $validasi = $request->validate([
        'nama' => 'required',
        'nisn' => 'required',
        'kelas' => 'required',
        'lomba' => 'required',
        'juara' => 'required',
        'penyelenggara' => 'required',
        'tingkat' => 'required',
        'date' => 'required|date',
        'sertifikat' => 'required|mimes:png,jpg,jpeg,pdf|max:2048', // Tambahkan validasi file
    ]);

    // Mengecek apakah ada petugas yang login
    $petugas = Auth::user(); 

    if (!$petugas) {
        // Jika tidak ada petugas yang login, tampilkan error atau redirect
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }
    // Proses upload file sertifikat
    $originalName = $request->file('sertifikat')->getClientOriginalName();
    $namaFile = time() . '_' . preg_replace('/\s+/', '_', $originalName);
    $request->file('sertifikat')->move(public_path('sertifikat'), $namaFile);

    // Simpan data prestasi ke database
    Prestasi::create([
        'id_petugas' => $petugas->id_petugas, // Mengaitkan dengan petugas yang sedang login
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'juara' => $request->juara,
        'lomba' => $request->lomba,
        'penyelenggara' => $request->penyelenggara,
        'tingkat' => $request->tingkat,
        'tanggal' => $request->date,
        'sertifikat' => $namaFile, // Menyimpan nama file sertifikat
    ]);

    return redirect()->route('prestasi')->with('sukses', 'Data Prestasi Berhasil Ditambahkan');
}

    public function petugas_edit_prestasi($id_prestasi)
    {
        $kejuaraan = Prestasi::find($id_prestasi);
        return view('petugas.edit_prestasi', compact(['kejuaraan']) , [
            "title" => 'Manajemen Prestasi'
        ]);
    }

    public function petugas_update_prestasi(Request $request, $id_prestasi)
{
    // Temukan data prestasi berdasarkan ID
    $kejuaraan = Prestasi::find($id_prestasi);

    if (!$kejuaraan) {
        return redirect()->route('prestasi')->with('error', 'Prestasi tidak ditemukan');
    }

    // Validasi input
    $request->validate([
        'nama' => 'required',
        'nisn' => 'required',
        'kelas' => 'required',
        'lomba' => 'required',
        'juara' => 'required',
        'penyelenggara' => 'required',
        'tingkat' => 'required',
        'date' => 'required|date',
        'sertifikat' => 'nullable|mimes:png,jpg,jpeg,pdf|max:2048', // Sertifikat opsional saat update
    ]);

    $namaFile = $kejuaraan->sertifikat; 

    // Jika ada file baru yang diunggah
    if ($request->hasFile('sertifikat')) {
        // Hapus file lama jika ada
        if (file_exists(public_path('sertifikat/' . $kejuaraan->sertifikat))) {
            File::delete(public_path('sertifikat/' . $kejuaraan->sertifikat));
        }

        // Proses upload file baru
        $originalName = $request->file('sertifikat')->getClientOriginalName();
        $namaFile = time() . '_' . preg_replace('/\s+/', '_', $originalName);
        $request->file('sertifikat')->move(public_path('sertifikat'), $namaFile);
    }

    // Update data prestasi
    $kejuaraan->update([
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'kelas' => $request->kelas,
        'juara' => $request->juara,
        'lomba' => $request->lomba,
        'penyelenggara' => $request->penyelenggara,
        'tingkat' => $request->tingkat,
        'tanggal' => $request->date,
        'sertifikat' => $namaFile, // Simpan nama file baru atau lama
    ]);

    return redirect()->route('prestasi')->with('sukses', 'Data Prestasi Berhasil Diedit');
}
public function petugas_delete_prestasi($id_prestasi)
{
    $data = Prestasi::find($id_prestasi);

    if (!$data) {
        return redirect()->route('prestasi')->with('error', 'Data tidak ditemukan');
    }

    // Hapus file sertifikat jika ada
    if (file_exists(public_path('sertifikat/' . $data->sertifikat))) {
        File::delete(public_path('sertifikat/' . $data->sertifikat));
    }

    // Hapus data dari database
    $data->delete();

    return redirect()->route('prestasi')->with('sukses', 'Data Berhasil Dihapus');
}

    public function perolehan_prestasi($id_prestasi)
    {
        $lomba = Lomba::find($id_prestasi);
        return view('petugas.perolehan_prestasi',compact(['lomba']) , [
            "title" => 'Manajemen Lomba'
        ]);
    }

    public function konfirmasi_lomba(Request $request, $id_lomba)
    {
        // Cari data lomba berdasarkan ID
        $lomba = Lomba::find($id_lomba);        

        if (!$lomba) {
            return redirect()->route('lomba')->with('error', 'Lomba tidak ditemukan');
        }

        // Buat data prestasi dari data lomba
        Prestasi::create([
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
            'nama' => $lomba->nama,
            'nisn' => $lomba->nisn,
            'kelas' => $lomba->kelas,
            'juara' => $request->juara,
            'lomba' => $lomba->lomba,
            'penyelenggara' => $lomba->penyelenggara,
            'tingkat' => $lomba->tingkat,
            'tanggal' => $lomba->tanggal,
            'sertifikat' => $lomba->sertifikat, // Sertifikat disalin
        ]);

        $lomba->status = Lomba::STATUS_DITERIMA; // Gunakan konstanta model
        $lomba->save();

        return redirect()->route('lomba')->with('sukses', 'Prestasi Dikonfirmasi');
    }

    // =======================
    // Fungsi Siswa
    // =======================
    public function siswa_prestasi()
    {
        $userName = Auth::guard('siswa')->user()->nama;
        $kejuaraan = Prestasi::where("nama", 'like', "%" . $userName . "%")->get();

        return view('siswa.prestasi', compact('kejuaraan'), [
            "title" => 'Perolehan Prestasi'
        ]);
    }

   public function cetak_prestasi()
    {
    if (Auth::guard('siswa')->check()) {
        // Jika yang login adalah siswa, ambil data prestasi berdasarkan NISN siswa
        $nisn = Auth::guard('siswa')->user()->nisn;
        $kejuaraan = Prestasi::where('nisn', $nisn)->get();
    } elseif (Auth::guard('petugas')->check()) {
        // Jika yang login adalah petugas, ambil semua data prestasi
        $kejuaraan = Prestasi::all();
    } else {
        return redirect()->route('siswa.login')->with('error', 'Anda harus login terlebih dahulu.');
    }
        return view('cetak_prestasi', compact('kejuaraan'));
    }
}
