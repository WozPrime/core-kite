<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->foreignId('instance_id');
            $table->foreignId('client_id');
            $table->string('project_code')->unique();
            $table->string('project_name');
            $table->string('project_status')->nullable();
            $table->date('project_start_date')->nullable();
            $table->date('project_deadline')->nullable();
            $table->text('project_detail')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
