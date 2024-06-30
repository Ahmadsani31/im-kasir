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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->uuid('transaksi_uuid')->unique();
            $table->string('invoice')->unique();
            $table->string('costumer_nama');
            $table->string('costumer_nama');
            $table->string('metode_bayar');
            $table->float('sub_harga', 12, 2);
            $table->float('pajak', 12, 2);
            $table->float('total_harga', 12, 2);
            $table->float('bayar', 12, 2);
            $table->float('kembalian', 12, 2);
            $table->bigInteger('diskon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
