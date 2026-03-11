<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabangs', function (Blueprint $table) {

            $table->id();

            $table->string('kode_cabang')->unique();
            $table->string('kota');
            $table->string('provinsi');

            $table->date('tanggal_peresmian');

            $table->string('email');

            $table->enum('status', ['Aktif','Nonaktif'])
                  ->default('Aktif');

            $table->string('detail_lokasi')->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};