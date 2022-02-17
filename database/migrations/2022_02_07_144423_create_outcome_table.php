<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengeluaran');
            $table->string('kode_pengeluaran');
            $table->string('kategori_pengeluaran');
            $table->date('tanggal_pengeluaran');
            $table->string('jenis_pengeluaran');
            $table->string('nominal_pengeluaran');
            $table->string('tujuan_pengeluaran');
            $table->string('nota_pengeluaran');
            $table->text('keterangan_pengeluaran')->nullable();
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
        Schema::dropIfExists('outcome');
    }
}
