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
            $table->bigIncrements('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('desc_ar')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('type')->nullable();
            $table->string('img')->nullable();
            $table->string('price')->nullable();
            $table->enum('discount',['none','money','persentage'])->default('none');
            $table->string('price_persentage_discount')->nullable();
            $table->string('price_money_discount')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();	
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id')->nullable();	
            $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::dropIfExists('products');
    }
}
