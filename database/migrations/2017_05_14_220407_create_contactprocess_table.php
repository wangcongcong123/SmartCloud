<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactprocessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('contactprocess', function (Blueprint $table) {

            $table->increments('process_id');
            $table->string('sender');
            $table->string('receiver');
            $table->timestamps();

            $table->foreign('sender')->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('receiver')->references('email')->on('users')
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

        Schema::drop('contactprocess');
    }
}
