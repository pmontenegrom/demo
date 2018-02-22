<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsSchemasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_schemas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->string('name', 255);
			$table->string('admin_view', 50);
			$table->string('front_view', 50);
			$table->integer('iterations')->unsigned()->nullable();
			$table->boolean('is_page')->nullable();
			$table->integer('position')->unsigned()->nullable();
			$table->boolean('active')->nullable();
			$table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('cms_schemas')
                  ->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cms_schemas');
	}

}
