<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('finance_id');
            $table->integer('finance_status');
            $table->string('bank_name')->nullable();
            $table->integer('amount')->nullable();
            $table->string('interest')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('finance_responses');
    }
}
