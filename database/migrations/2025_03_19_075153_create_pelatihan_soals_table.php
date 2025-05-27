<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('pelatihan_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['pg', 'essay']);
            $table->text('pertanyaan');
            $table->string('opsi_a')->nullable();
            $table->string('opsi_b')->nullable();
            $table->string('opsi_c')->nullable();
            $table->string('opsi_d')->nullable();
            $table->string('jawaban');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('pelatihan_soals');
    }
};
