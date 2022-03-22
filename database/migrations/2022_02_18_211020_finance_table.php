<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance', function (Blueprint $table) {
            $table->id();
            $table->string('name_finance');
            // $table->string('code_finance');
            $table->date('date_finance');
            $table->string('category_finance');
            $table->string('type_finance');
            $table->string('nominal_finance');
            $table->string('balance_finance');
            $table->string('nota_finance');
            $table->string('inout_finance');
            $table->text('detail_finance')->nullable();
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
        Schema::dropIfExists('Finance');
    }
}
