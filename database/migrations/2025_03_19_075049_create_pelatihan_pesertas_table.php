<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pelatihan_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pelatihan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['baru', 'berjalan', 'selesai', 'tidak selesai'])->default('baru');
            $table->integer('nilai')->nullable();
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pelatihan_pesertas');
    }
};
