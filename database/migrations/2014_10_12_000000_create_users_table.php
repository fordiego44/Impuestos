<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('slug')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('dni')->nullable();
            $table->string('ruc')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_susti')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('department')->nullable();
            $table->integer('province')->nullable();
            $table->integer('district')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('image')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('description')->nullable();
            $table->string('business')->nullable();
            $table->string('paypal1')->nullable();
            $table->string('paypal2')->nullable();
            $table->string('paypal3')->nullable();

            $table->string('code')->nullable();
            $table->string('access_token')->nullable();
            $table->string('token_type')->nullable();
            $table->string('expires_in')->nullable();
            $table->string('scope')->nullable();
            $table->string('id_MP')->nullable(); //creado
            $table->string('refresh_token')->nullable();
            $table->string('public_key')->nullable();
            $table->string('live_mode')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
