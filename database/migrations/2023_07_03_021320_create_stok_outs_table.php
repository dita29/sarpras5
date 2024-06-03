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
        Schema::create('stok_outs', function (Blueprint $table) {
            $table->string('nama_produk', 100)->nullable();
            $table->integer('qty')->nullable();
            $table->string('pemohon', 100)->nullable();
            $table->string('keterangan', 100)->nullable()->default('Tanpa Keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_outs');
    }
};
