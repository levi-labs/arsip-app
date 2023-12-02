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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_id')->unsigned();
            $table->string('kode_barang_masuk', 32);
            $table->string('sumber_barang', 20);
            $table->string('kode_surat', 32);
            $table->integer('qty_masuk');
            $table->integer('qty_rusak');
            $table->integer('qty_diterima');
            $table->string('satuan', 32);
            $table->string('harga_beli');
            $table->date('tanggal_masuk');
            $table->string('foto_surat', 60);
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
