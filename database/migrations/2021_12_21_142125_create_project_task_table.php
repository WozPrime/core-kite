<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id')->unsigned()->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onUpdate('cascade')->onDelete('cascade'); 
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); 
            $table->unsignedBigInteger('project_id')->unsigned()->index();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade'); 
            $table->text('details')->nullable();
            $table->text('upload_details')->nullable();
            $table->text('feedback')->nullable();
            $table->integer('status')->nullable();
            $table->integer('points')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('post_date')->nullable();
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
        Schema::dropIfExists('project_task');
    }
}
