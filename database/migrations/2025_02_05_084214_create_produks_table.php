<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('produks', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->string('nama_pemilik');
        $table->string('alamat');
        $table->string('whatsapp');
        $table->string('link_olshop')->nullable();
        $table->string('link_sosmed')->nullable();
       $table->json('foto')->nullable();
        $table->timestamps();
    });

    Schema::table('produks', function (Blueprint $table) {
        $table->dropColumn('foto');
    });

    Schema::table('produks', function (Blueprint $table) {
        $table->string('thumbnail')->nullable()->after('kategori');
    });
    
    
    
}



public function down(): void
{
    Schema::dropIfExists('produks');
}
};
