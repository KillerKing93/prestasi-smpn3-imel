<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $primaryKey = 'id_berita';

    // Tentukan atribut yang dapat diisi (fillable)
    protected $fillable = [
        'id_petugas',  
        'title',       
        'deskripsi',        
        'body',   
        'photo',       
    ];

    // Tentukan relasi dengan model Petugas (Berita belongs to Petugas)
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    // Menggunakan mutator untuk memformat created_at dengan diffForHumans
    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : 'Belum tersedia';
    }
}
