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
        Schema::create('transaksi_meja_detail', function (Blueprint $table) {
            $table->id('transaksi_meja_detail_id');
            $table->foreignId('transaksi_id')->constrained('transaksi', 'transaksi_id')->cascadeOnDelete();
            $table->foreignId('meja_id')->constrained('meja', 'meja_id');
            $table->float('harga', 12, 2);
            $table->integer('durasi');
            $table->float('total_harga', 12, 2);
            $table->datetimes('jam_mulai');
            $table->datetimes('jam_selesai');
            $table->enum('lampu', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_meja_details');
    }
};
