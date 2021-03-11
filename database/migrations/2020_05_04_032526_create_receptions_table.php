<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_user');
          $table->integer('deliverier_id');
          $table->integer('pending');
          $table->foreignId('customer_id');
          $table->integer('coupon');
          $table->integer('state');
          $table->dateTime('date_reception');
          $table->string('name');
          $table->string('last_name');
          $table->string('address');
          $table->string('departament');
          $table->string('province');
          $table->string('district');
          $table->string('telephone');
          $table->string('cellphone');
          $table->string('address_email');
          $table->string('latitude');
          $table->string('longitude');
          $table->string('image');
          $table->integer('transfer')->nullable();
          $table->integer('state');
          $table->integer('state_delivery');
          $table->integer('advanced_payments_id');
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
        Schema::dropIfExists('receptions');
    }
}
