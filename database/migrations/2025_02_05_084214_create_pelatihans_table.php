<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('foto')->nullable();
            $table->text('deskripsi');
            $table->string('kategori');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->enum('tipe', ['offline', 'online', 'hybrid']);
            $table->string('penyelenggara');
            $table->boolean('khusus_umkm_patikraja')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelatihans');
    }
};
