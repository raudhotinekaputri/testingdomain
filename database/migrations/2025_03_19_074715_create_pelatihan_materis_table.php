<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pelatihan_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['video', 'dokumen']);
            $table->string('file')->nullable();
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pelatihan_materis');
    }
};
