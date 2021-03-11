<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('protocolos', function (Blueprint $table) {
          $table->increments('id');
          $table->foreignId('deliverier_id');
          $table->string('quest1')->nullable();
          $table->string('quest2')->nullable();
          $table->string('quest3')->nullable();
          $table->string('quest4')->nullable();
          $table->string('quest5')->nullable();
          $table->string('quest6')->nullable();
          $table->string('quest7')->nullable();
          $table->string('quest8')->nullable();
          $table->string('quest9')->nullable();
          $table->string('quest10')->nullable();
          $table->string('quest11')->nullable();
          $table->string('quest12')->nullable();
          $table->string('quest13')->nullable();
          $table->string('quest14')->nullable();
          $table->string('quest15')->nullable();
          $table->string('quest16')->nullable();
          $table->string('quest17')->nullable();
          $table->string('quest18')->nullable();
          $table->dateTime('date_reception');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolos');
    }
}
