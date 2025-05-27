<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pelatihan_khusus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('kategori_id');
            $table->time('jam');
            $table->enum('tipe', ['online', 'offline']);
            $table->string('lokasi')->nullable();
            $table->string('penyelenggara');
            $table->boolean('khusus_umkm_patikraja')->default(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pelatihan_khusus');
    }
};
