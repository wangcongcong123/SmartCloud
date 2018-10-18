<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
    	Schema::create('files', function (Blueprint $table) {
    		$table->increments('file_id');
    		$table->string('user_account');
    		$table->string('filename');
    		$table->string('filepath');
    		$table->string('desc',500);
    		$table->string('filetype');
    		$table->integer('filesize');
    		$table->integer('parent_id')->unsigned();
    		$table->string('status');
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
        Schema::drop('files');
    }
}
