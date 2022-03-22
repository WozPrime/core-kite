<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('client_id');
            $table->timestamp('tanggal_pertemuan');
            $table->text('deskripsi_pertemuan');
            $table->text('hasil_pertemuan')->nullable();
            $table->text('dokumen_pertemuan')->nullable();
            $table->text('status_pertemuan');
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
        Schema::dropIfExists('meetings');
    }
}
