<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('acaras', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable(); // Bisa kosong
            $table->date('tanggal');
            $table->enum('kategori', ['Bazar']); // Bisa ditambah nanti
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acaras');
    }
};
