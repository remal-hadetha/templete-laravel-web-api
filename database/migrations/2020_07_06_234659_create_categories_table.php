<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('type')->nullable();
            $table->string('img')->nullable();
            $table->enum('express_delivery',['0','1'])->default('0');
            $table->string('quantity_limit')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();	
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
          
            $table->unsignedBigInteger('city_id')->nullable();	
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
   
            $table->unsignedBigInteger('category_id')->nullable();	
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
   
            $table->enum('active',['0','1'])->nullable();
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
        Schema::dropIfExists('categories');
    }
}
