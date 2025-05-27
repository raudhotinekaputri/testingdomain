<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Informasi Pribadi
            $table->string('nama');
            $table->string('no_whatsapp');
            $table->text('alamat');

            // Informasi Usaha
            $table->string('nama_usaha');
            $table->text('alamat_usaha');
            $table->string('kategori_usaha');
            $table->string('nomor_izin_usaha');
            $table->string('nomor_whatsapp_usaha');
            $table->string('link_olshop_1')->nullable();
            $table->string('link_olshop_2')->nullable();
            $table->text('deskripsi_usaha');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
};
