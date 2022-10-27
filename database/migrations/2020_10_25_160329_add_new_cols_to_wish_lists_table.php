<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColsToWishListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wish_lists', function (Blueprint $table) {
            //
            $table->string('content')->nullable();
            $table->unsignedBigInteger('salon_id')->nullable();	
            $table->foreign('salon_id')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wish_lists', function (Blueprint $table) {
            //
            $table->dropColumn('content');
            $table->dropForeign('wish_lists_salon_id_foreign');
            $table->dropColumn('salon_id');
        });
    }
}
