<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('fcm')->nullable();
            $table->enum('device_type', ['android', 'ios', 'win_phone', 'windows', 'linux', 'mac', 'undefined'])->nullable();
            $table->text('jwt')->nullable();
            $table->enum('is_logged_in', ['true', 'false'])->default('false');
            $table->ipAddress('ip')->nullable();
            $table->macAddress('mac')->nullable();
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
        Schema::dropIfExists('tokens');
    }
}
