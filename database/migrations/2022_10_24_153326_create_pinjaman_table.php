<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_pinjaman', 15, 2);
            $table->decimal('saldo_pinjaman', 15, 2);
            $table->date('tanggal_pinjam')->nullable();
            $table->enum('status', ['1', '0'])->comment('1=acc 0=belum acc')->nullable();
            $table->integer('tenor');
            $table->decimal('tunggakan', 15, 2)->nullable();
            $table->decimal('angsuran_bunga', 15, 2);
            $table->decimal('angsuran_pokok', 15, 2);
            $table->integer('suku_bunga');
            $table->decimal('total_angsuran', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjamen');
    }
}
