<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();	
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('work_start')->nullable();
            $table->string('work_end')->nullable();
            $table->string('available')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn('work_start');
            $table->dropColumn('work_end');
            $table->dropColumn('available');  
        });
    }
}
