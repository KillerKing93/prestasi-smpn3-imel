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
        Schema::create('beritas', function (Blueprint $table) {
            $table->bigIncrements('id_berita');                  
            $table->unsignedInteger('id_petugas');                       
            $table->string('title', 255);                      
            $table->string('deskripsi', 255);                      
            $table->text('body');                         
            $table->string('photo', 255);  
            $table->timestamps();

            // Menambahkan foreign key untuk kolom id_petugas yang mengacu ke kolom id_petugas di tabel petugas
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
