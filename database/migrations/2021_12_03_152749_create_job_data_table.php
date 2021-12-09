<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posts_id')->nullable();
            $table->foreignId('users_id');
            $table->foreignId('project_id');
            $table->foreignId('prof_id')->nullable();
            $table->string('file_name')->nullable();
            $table->dateTime('expired_at')->nullable();
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
        Schema::dropIfExists('job_data');
    }
}
