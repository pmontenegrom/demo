<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTranslatesAliasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('cms_translates_alias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->string('alias', 50);
			$table->timestamps();

			$table->foreign('group_id')
				  ->references('id')
				  ->on('cms_translates_group')
				  ->onDelete('cascade');

		});	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cms_translates_alias');
		Schema::dropIfExists('cms_translates_group');
	}

}
