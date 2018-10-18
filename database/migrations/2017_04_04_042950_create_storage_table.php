<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('storage', function (Blueprint $table) {
    		$table->increments('id');
    		$table->double('total_volum');
    		$table->double('used_volum');
    		$table->string('user_account')->unique();
    		$table->timestamps();
    		$table->foreign('user_account')->references('email')->on('users')
    		->onDelete('cascade')
    		->onUpdate('cascade');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    	Schema::drop('storage');
    }
}
