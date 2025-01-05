<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Prestasi extends Model
{
    use HasFactory, Sortable;

    // Tentukan nama tabel
    protected $table = 'prestasis';

    // Tentukan primary key
    protected $primaryKey = 'id_prestasi';

    // Tentukan atribut yang dapat diisi (fillable)
    protected $fillable = [
        'id_petugas', 
        'nisn', 
        'nama', 
        'kelas', 
        'juara', 
        'lomba', 
        'penyelenggara', 
        'tingkat', 
        'tanggal',
        'sertifikat',
    ];

    // Tentukan sortable columns
    public $sortable = ['nama', 'nisn', 'kelas', 'tingkat', 'tanggal', 'juara'];

    // Relasi dengan model Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    // Relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }
}

