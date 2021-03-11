<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveriers', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('id_user')->nullable();
              // $table->integer('deliverier_id')->nullable();
              // $table->string('user_name')->unique();
           
              $table->string('name');
              $table->string('last_name');
              $table->string('dni');
              $table->string('email');
              $table->string('password');
              $table->string('direction');
              $table->string('phone');
           
              $table->string('image');
              $table->integer('state_deliver')->nullable();
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
        Schema::dropIfExists('deliveriers');
    }
}
