<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharelistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharelist', function (Blueprint $table) {

            $table->increments('share_id');

            $table->string('share_link');
            $table->string('valid_time',10);
            $table->string('share_password')->nullable();
            $table->string('qrcode_path');

            $table->string('user_account');

            $table->unsignedInteger('file_id');

            $table->timestamps();

            $table->foreign('user_account')->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('file_id')->references('file_id')->on('files')
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
        Schema::drop('sharelist');
    }
}
