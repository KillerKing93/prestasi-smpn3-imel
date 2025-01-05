<?php

return [

    /*
    |---------------------------------------------------------------------- 
    | Authentication Defaults
    |---------------------------------------------------------------------- 
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'petugas', // Set default guard untuk petugas
        'passwords' => 'petugas', // Menggunakan reset password untuk petugas
    ],

    /*
    |---------------------------------------------------------------------- 
    | Authentication Guards
    |---------------------------------------------------------------------- 
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas', // Guard untuk petugas
        ],

        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas', // Ganti provider  ke "siswas" karna nama tabelnya itu siswas
        ],
    ],

    /*
    |---------------------------------------------------------------------- 
    | User Providers
    |---------------------------------------------------------------------- 
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        // Provider untuk petugas (gunakan tabel `petugas` dan model `Petugas`)
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,  // Model Petugas
        ],

        // Provider untuk siswa (ubah menjadi `siswas` dan model `Siswa`)
        'siswas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,  // Model Siswa
        ],
    ],

    /*
    |---------------------------------------------------------------------- 
    | Resetting Passwords
    |---------------------------------------------------------------------- 
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        // Password reset untuk petugas (gunakan tabel `password_resets` untuk petugas)
        'petugas' => [
            'provider' => 'petugas',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Password reset untuk siswa (gunakan tabel `password_resets` untuk siswa)
        'siswas' => [
            'provider' => 'siswas', // Ganti provider ke "siswas"
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |---------------------------------------------------------------------- 
    | Password Confirmation Timeout
    |---------------------------------------------------------------------- 
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,
];
