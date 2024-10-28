<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('jenis_lembaga');
            $table->date('tahun_berdiri');
            $table->bigInteger('no_oprasional');
            $table->bigInteger('no_wa');
            $table->string('dikeluarkan_oleh');
            $table->text('alamat');
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
