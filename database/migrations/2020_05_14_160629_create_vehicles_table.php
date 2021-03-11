<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('delivery')->nullable();
            $table->string('plaque')->nullable();
            $table->string('type')->nullable();
            
            $table->string('license')->nullable();
            $table->string('vehiclephoto')->nullable();
            $table->string('category')->nullable();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->string('soat')->nullable();
            $table->string('vehicleserie')->nullable();
            $table->string('description')->nullable();

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
        Schema::dropIfExists('vehicles');
    }
}
