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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->bigIncrements('id_prestasi');          
            $table->unsignedInteger('id_petugas');                          
            $table->string('nama', 255);                          
            $table->string('nisn');                            
            $table->string('kelas', 255);                          
            $table->string('juara', 255);                          
            $table->string('lomba', 255);                          
            $table->string('penyelenggara', 255);                   
            $table->string('tingkat', 255);                        
            $table->date('tanggal'); 
            $table->string('sertifikat', 255)->nullable();                               
            $table->timestamps();

            // Foreign key untuk kolom id_petugas yang mengacu pada tabel petugas
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
            // Foreign key untuk kolom nisn yang mengacu pada tabel siswa
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
