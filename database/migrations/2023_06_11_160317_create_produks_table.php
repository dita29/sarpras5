<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk', 100);
            $table->string('kode_produk', 25)->unique();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('tempat_id')->nullable();
            $table->string('pinjam', 10);
            $table->integer('qty')->nullable();
            $table->string('foto_produk', 50)->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('tempat_id')->references('id')->on('tempats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
