<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pelatihan_user_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('pelatihan_soals')->onDelete('cascade');
            $table->text('jawaban');
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }
    
};
