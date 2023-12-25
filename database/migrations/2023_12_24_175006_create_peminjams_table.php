<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('no_peminjaman');
            $table->unsignedBigInteger('books_id');
            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pengunjung_id');
            $table->foreign('pengunjung_id')->references('id')->on('pengunjungs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('pegawai_id');
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
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
        Schema::dropIfExists('peminjams');
    }
}
