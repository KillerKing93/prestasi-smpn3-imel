<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingpageController extends Controller
{
    public function index(){
        // Mengambil data berita dan prestasi (kejuaraan)
        $berita = Berita::paginate(10);  // Menampilkan 10 berita per halaman
        $kejuaraan = Prestasi::all();    
        
        // Kirim data ke view
        return view('landingpage.index', [
            "title" => 'Beranda',
            "berita" => $berita,
            "kejuaraan" => $kejuaraan  
        ]);
    }
    public function show_detail($id_berita)
    {
        $berita = Berita::find($id_berita);

        if (!$berita) {
            return redirect()->route('berita')->with('error', 'Berita tidak ditemukan.');
        }
        // Menggunakan path view yang benar
        return view('landingpage.detail_berita', compact('berita'), [
            "title" => 'Detail Berita'
        ]);
    }
    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return redirect('/');
    }
}
