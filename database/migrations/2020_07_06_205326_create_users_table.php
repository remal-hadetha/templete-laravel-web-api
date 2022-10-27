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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('mobile_code')->nullable();
            $table->string('active_code')->nullable();
            $table->enum('active',['0','1'])->default('0');
            $table->string('img')->nullable();
            $table->string('residence_img')->nullable();
            $table->string('license_img')->nullable();
            $table->enum('type',['user','provider'])->default('user');
            $table->string('total_rate')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();	
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();	
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        
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
        Schema::dropIfExists('users');
    }
}
