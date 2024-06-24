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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('katagori_id')->constrained('katagori', 'katagori_id');
            $table->string('nama');
            $table->float('harga', 12, 2);
            $table->float('harga_jual', 12, 2);
            $table->integer('stock');
            $table->text('keterangan')->nullable();
            $table->text('gambar')->nullable();
            $table->string('user_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
