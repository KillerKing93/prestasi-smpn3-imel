<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\LandingpageController;

// Router Landingpage
Route::get('/', [LandingpageController::class , 'index']);
Route::get('berita/{id_berita}', [LandingpageController::class, 'show_detail']);
Route::get('keluar', [LandingpageController::class , 'logout'])->name('keluar');
// End

// Route Autentifikasi Login
Route::group([], function () {
    Route::group(['middleware' => ['cek_login:petugas']], function () {
    // Route Petugas
        Route::get('petugas', [PetugasController::class, 'index'])->name('petugas');
        Route::get('petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard')->middleware('cek_login:petugas'); 
        Route::get('profil_petugas/{id_petugas}',[PetugasController::class , 'profil'])->name('petugas_profil');
        Route::post('update_profil_petugas/{id_petugas}',[PetugasController::class , 'update_profil'])->name('petugas_update_profil');

        // Route Manajemen Siswa
        Route::get('/petugas/siswa', [PetugasController::class, 'siswa'])->name('petugas.siswa');
        Route::get('add_siswa', [PetugasController::class, 'add_siswa']);
        Route::post('proses_tambah', [PetugasController::class, 'create_siswa'])->name('daftarkan_siswa');
        Route::get('/edit_siswa/{nisn}', [PetugasController::class, 'edit_siswa']);
        Route::post('proses_edit/{nisn}', [PetugasController::class, 'update_siswa'])->name('update_siswa');
        Route::get('/petugas/siswa/delete/{nisn}', [PetugasController::class, 'delete_siswa'])->name('petugas.delete_siswa');
        // 

        // Route Manajemen Prestasi
        Route::get('prestasi', [PrestasiController::class , 'index'])->name('prestasi');
        Route::get('add_prestasi', [PrestasiController::class , 'petugas_add_prestasi']);
        Route::post('prestasi', [PrestasiController::class , 'petugas_create_prestasi']);
        Route::get('/edit_prestasi/{id_prestasi}', [PrestasiController::class , 'petugas_edit_prestasi'])->name('edit_prestasi');
        Route::post('update_prestasi/{id_prestasi}', [PrestasiController::class, 'petugas_update_prestasi'])->name('petugas_update_prestasi');
        Route::get('prestasi/delete/{id_prestasi}', [PrestasiController::class, 'petugas_delete_prestasi']);
        // 

        // Route Manajemen Lomba
        Route::get('/lomba' , [LombaController::class , 'lomba'])->name('lomba');
        Route::get('add_lomba', [LombaController::class , 'petugas_add_lomba']);
        Route::post('lomba', [LombaController::class , 'petugas_create_lomba']);
        Route::get('/edit_lomba/{id_lomba}',[LombaController::class , 'petugas_edit_lomba']);
        Route::put('update_lomba/{id_lomba}', [LombaController::class , 'petugas_update_lomba'])->name('petugas_update_lomba');
        Route::get('lomba/delete/{id_lomba}', [LombaController::class, 'petugas_delete_lomba']);
        Route::put('konfirmasi_lomba/{id_lomba}', [PrestasiController::class , 'konfirmasi_lomba'])->name('konfirmasi_lomba'); 
        //

        // Route Manajemen Berita
        Route::get('/berita', [BeritaController::class , 'index'])->name('berita');
        Route::get('/add_berita', [BeritaController::class , 'add_berita']);
        Route::post('berita', [BeritaController::class , 'create'])->name('create_post');
        Route::get('/edit_berita/{id_berita}', [BeritaController::class , 'edit']);
        Route::put('update_berita/{id_berita}', [BeritaController::class , 'update'])->name('update_post');
        Route::get('berita/delete/{id_berita}', [BeritaController::class, 'destroy']);
        Route::get('tambahkan_berita/{id_berita}', [BeritaController::class , 'add_berita']);
        // 
    // End Route Petugas

    });

    // Route untuk siswa setelah login
    Route::group(['middleware' => ['cek_login:siswa']], function () {
       
        Route::get('siswa', [SiswaController::class, 'index'])->name('siswa'); 
        Route::get('siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard')->middleware('cek_login:siswa');
        // Profil siswa
        Route::get('siswa/profil/{nisn}', [SiswaController::class, 'profil'])->name('siswa.profil');
        Route::post('siswa/profil/update/{nisn}', [SiswaController::class, 'update_profil'])->name('siswa.update_profil');
        // Manajemen Lomba
        Route::get('siswa/lomba', [LombaController::class, 'siswa_lomba'])->name('siswa.lomba'); 
        Route::get('siswa/lomba/daftar', [LombaController::class, 'daftarkan_lomba'])->name('siswa.lomba.daftarkan'); 
        Route::post('siswa/lomba/tambah', [LombaController::class, 'siswa_create_lomba'])->name('siswa.lomba.store'); 
        Route::get('siswa/lomba/edit/{id_lomba}', [LombaController::class, 'siswa_edit_lomba'])->name('siswa.lomba.edit'); 
        Route::put('siswa/lomba/update/{id_lomba}', [LombaController::class, 'siswa_update_lomba'])->name('siswa.lomba.update');
        Route::delete('siswa/lomba/{id_lomba}', [LombaController::class, 'siswa_delete_lomba'])->name('siswa.lomba.delete'); 
        
        // Manajemen Prestasi
        Route::get('siswa/prestasi', [PrestasiController::class, 'siswa_prestasi'])->name('siswa.prestasi'); 
    });
});
// 

// Rute Autentikasi Siswa
Route::get('siswa/register', [SiswaController::class, 'showRegisterForm'])->name('siswa.register');
Route::post('siswa/register', [SiswaController::class, 'proses_register'])->name('proses_register');
Route::get('siswa/login', [SiswaController::class, 'showLoginForm'])->name('siswa.login');
Route::post('siswa/login', [SiswaController::class, 'login']);
Route::post('siswa/logout', [SiswaController::class, 'logout'])->name('siswa.logout');


// Rute Autentikasi Petugas
Route::get('petugas/login', [PetugasController::class, 'showLoginForm'])->name('petugas.login');
Route::post('petugas/login', [PetugasController::class, 'login']);
Route::post('petugas/logout', [PetugasController::class, 'logout'])->name('petugas.logout');

// Route untuk cetak prestasi
Route::get('/prestasi/cetak', [PrestasiController::class, 'cetak_prestasi'])->name('prestasi.cetak');

Route::get('/re', function () {
    return view('auth.register');
});