<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email', 255)->unique();
            $table->string('password', 60);
            $table->integer('profile_id')->unsigned();
            $table->string('name', 255);
            $table->boolean('active')->nullable();
            $table->boolean('default')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('profile_id')
                  ->references('id')
                  ->on('profiles'); //->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}
