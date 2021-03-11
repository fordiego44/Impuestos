<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_user')->nullable();
          $table->string('id_category')->nullable();
          $table->string('name');
          $table->string('slug')->nullable();
          $table->string('description');
          $table->float('price');
          $table->string('image');
          $table->integer('state_delete')->nullable(); 
          $table->string('time_delay')->nullable();
          $table->integer('status_gallery')->nullable();

          $table->integer('categoryWeight')->nullable();
          $table->float('weight')->nullable();
          $table->integer('categoryDimension')->nullable();
          $table->float('high')->nullable();
          $table->float('wide')->nullable();
          $table->float('length')->nullable();

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
        Schema::dropIfExists('products');
    }
}
