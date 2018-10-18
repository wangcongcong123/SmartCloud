<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('contact', function (Blueprint $table) {

            $table->increments('contact_id');
            $table->string('user_account');
            $table->string('face')->nullable();
            $table->string('signature',500)->nullable();
            $table->string('channel');
            $table->string('friend_account');

            $table->timestamps();

            $table->foreign('user_account')->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('friend_account')->references('email')->on('users')
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

        Schema::drop('contact');
    }
}
