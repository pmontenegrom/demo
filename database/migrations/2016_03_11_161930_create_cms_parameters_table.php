<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('cms_parameters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('lang_id')->unsigned();
			$table->string('name', 255);
			$table->string('value', 255)->nullable();
			$table->boolean('active')->nullable();
			$table->timestamps();

			$table->foreign('group_id')
				  ->references('id')
				  ->on('cms_parameters_group')
				  ->onDelete('cascade');

			$table->foreign('lang_id')
				  ->references('id')
				  ->on('cms_langs');// ->onDelete('cascade');

		});	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cms_parameters');
		Schema::dropIfExists('cms_parameters_group');
	}

}
