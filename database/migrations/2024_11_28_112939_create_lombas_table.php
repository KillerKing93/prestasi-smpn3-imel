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
        Schema::create('lombas', function (Blueprint $table) {
            $table->bigIncrements('id_lomba'); 
            $table->unsignedInteger('id_petugas')->nullable(); 
            $table->string('nama', 255);                            
            $table->string('nisn');                           
            $table->string('kelas', 255);                          
            $table->string('lomba', 255);                          
            $table->string('penyelenggara', 255);                 
            $table->string('tingkat', 255);                        
            $table->date('tanggal');                               
            $table->string('sertifikat', 255)->nullable(); 
            $table->enum('status', [0, 1])->default(0);
            $table->timestamps();         
            
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade'); 
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
