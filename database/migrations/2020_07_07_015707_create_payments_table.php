<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_owner_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('cvv')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();	
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('coupon_id')->nullable();	
            $table->foreign('coupon_id')->references('id')->on('coupons');
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
        Schema::dropIfExists('payments');
    }
}
