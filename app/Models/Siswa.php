<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Siswa extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $hidden = [
        'password',
        'remember_token',
    ];
    // Guard khusus untuk siswa
    protected $guard = 'siswas';

    // Nama tabel di database
    protected $table = 'siswas';

    // Primary key khusus
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'int';

    // Kolom mass-assignable
    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'gender',
        'username',
        'email',
        'password',
        'profil',
    ];

    // Hash password secara otomatis saat pembuatan atau pembaruan

    // Metode untuk autentikasi
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
        Log::info('Login attempt for Siswa: Username = ' . $this->username);  // Log untuk debugging
        return $this->username;
    }
}
 