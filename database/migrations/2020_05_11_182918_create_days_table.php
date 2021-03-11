<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user')->nullable();
            $table->string('monday1')->nullable();
            $table->string('monday2')->nullable();
            $table->string('tuesday1')->nullable();
            $table->string('tuesday2')->nullable();
            $table->string('wednesday1')->nullable();
            $table->string('wednesday2')->nullable();
            $table->string('thursday1')->nullable();
            $table->string('thursday2')->nullable();
            $table->string('friday1')->nullable();
            $table->string('friday2')->nullable();
            $table->string('saturday1')->nullable();
            $table->string('saturday2')->nullable();
            $table->string('sunday1')->nullable();
            $table->string('sunday2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
