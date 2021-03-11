<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_attribute')->nullable();
          $table->string('name')->nullable();
          $table->float('price')->nullable();
          $table->string('image')->nullable();
          $table->integer('available')->nullable();
          $table->integer('state_delete')->nullable();
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
        Schema::dropIfExists('variations');
    }
}
