<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTranslatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('cms_translates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alias_id')->unsigned();
			$table->integer('lang_id')->unsigned();
			$table->string('name', 255);
			$table->timestamps();

			$table->foreign('alias_id')
				  ->references('id')
				  ->on('cms_translates_alias')
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
		Schema::dropIfExists('cms_translates');
		Schema::dropIfExists('cms_translates_alias');
		Schema::dropIfExists('cms_translates_group');
	}

}
