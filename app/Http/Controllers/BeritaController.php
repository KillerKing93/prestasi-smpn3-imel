<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::paginate(10); // Menggunakan pagination untuk mendukung metode links()
        return view('petugas.berita', compact('berita'), [
            "title" => 'Manajemen Berita'
        ]);
    }

    public function add_berita()
    {
        return view('petugas.add_berita', [
            "title" => 'Manajemen Berita'
        ]);
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'body' => 'required',
            'photo' => 'required|mimes:png,jpeg,jpg|max:2048',
        ]);

        $id_petugas = auth()->user()->id_petugas ?? null;

        if (!$id_petugas) {
            return redirect()->back()->with('error', 'ID Petugas tidak ditemukan');
        }

        $namafile = time() . '_' . $request->photo->getClientOriginalName();
        $request->photo->move(public_path('file_berita'), $namafile);

        Berita::create([
            'id_petugas' => $id_petugas,
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'body' => $request->body,
            'photo' => 'file_berita/' . $namafile,
        ]);

        return redirect()->route('berita')->with('sukses', 'Berita Berhasil Dibuat');
    }

    public function show()
    {
        $berita = Berita::latest()->paginate(4); // Menggunakan paginasi
        return view('landingpage.postingan', compact('berita'), [
            "title" => 'Berita'
        ]);
    }

    public function show_detail($id_berita)
    {
        $berita = Berita::find($id_berita);

        if (!$berita) {
            return redirect()->route('berita')->with('error', 'Berita tidak ditemukan.');
        }

        return view('detail_berita', compact('berita'), [
            "title" => 'Detail Berita'
        ]);
    }

    public function edit($id_berita)
    {
        $berita = Berita::find($id_berita);

        if (!$berita) {
            return redirect()->route('berita')->with('error', 'Berita tidak ditemukan.');
        }

        return view('petugas.edit_berita', compact('berita'), [
            "title" => 'Edit Berita'
        ]);
    }

    public function update(Request $request, $id_berita)
    {
        $berita = Berita::find($id_berita);

        if (!$berita) {
            return redirect()->route('berita')->with('error', 'Berita tidak ditemukan.');
        }

        $validasi = $request->validate([
            'title' => 'required',
            'deskripsi' => 'required',
            'body' => 'required',
            'photo' => 'nullable|mimes:png,jpeg,jpg|max:2048',
        ]);

        $cek = [
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'body' => $request->body,
        ];

        if ($request->hasFile('photo')) {
            File::delete(public_path($berita->photo));
            $namafile = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('file_berita'), $namafile);
            $cek['photo'] = 'file_berita/' . $namafile;
        }

        $berita->update($cek);

        return redirect()->route('berita')->with('sukses', 'Berita Berhasil Diedit');
    }

    public function destroy($id_berita)
    {
        $berita = Berita::find($id_berita);

        if (!$berita) {
            return redirect()->route('berita')->with('error', 'Berita tidak ditemukan.');
        }

        File::delete(public_path($berita->photo));
        $berita->delete();

        return redirect()->route('berita')->with('sukses', 'Berita Berhasil Dihapus');
    }
}
