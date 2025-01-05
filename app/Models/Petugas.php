<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Menambahkan Log untuk pemantauan

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Guard untuk petugas
    protected $guard = 'petugas';

    // Nama tabel
    protected $table = 'petugas';

    // Primary key
    protected $primaryKey = 'id_petugas';

    // Kolom mass-assignable
    protected $fillable = [
        'nama',
        'gender',
        'username',
        'email',
        'password',
        'profil',
    ];

    // Kolom autentikasi
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifier()
    {
        // Mengembalikan username sebagai identifier autentikasi
        return $this->username;
    }
}
