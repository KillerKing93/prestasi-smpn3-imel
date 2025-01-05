<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'lombas';

    // Tentukan primary key
    protected $primaryKey = 'id_lomba';

    // Tentukan atribut yang dapat diisi (fillable)
    protected $fillable = [
        'id_petugas',
        'nama',         
        'nisn',
        'kelas',
        'lomba',
        'penyelenggara',
        'tingkat',
        'tanggal',
        'sertifikat',
        'status',       
    ];

    // Konstanta untuk nilai status
    const STATUS_DITOLAK = '0';
    const STATUS_DITERIMA = '1';

    // Relasi ke model Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn');
    }

    // Accessor untuk label status
    public function getStatusLabelAttribute()
    {
        // Mengubah format status menjadi kapital (contoh: "ditolak" menjadi "Ditolak")
        return ucfirst($this->status);
    }

    // Scope untuk memfilter berdasarkan status
    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
