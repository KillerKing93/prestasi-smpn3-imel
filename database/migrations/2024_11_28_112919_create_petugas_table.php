<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->increments('id_petugas'); 
            $table->string('nama', 255);          
            $table->enum('gender', ['laki-laki', 'perempuan']); 
            $table->string('username')->unique(); 
            $table->string('email', 255)->nullable();
            $table->string('password', 255);          
            $table->string('profil', 255)->nullable();
            $table->timestamps();                   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
