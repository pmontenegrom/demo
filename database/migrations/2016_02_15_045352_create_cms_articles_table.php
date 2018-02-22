<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cms_articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('schema_id')->unsigned();
			$table->integer('lang_id')->unsigned();
			$table->string('title', 255);
			$table->string('subtitle', 255)->nullable();
			$table->string('subtitle2', 255)->nullable();
			$table->text('resumen')->nullable();
			$table->text('description')->nullable();
			$table->text('description2')->nullable();
			$table->text('description3')->nullable();
			$table->dateTime('date')->nullable();
			$table->tinyInteger('ref_type')->unsigned()->nullable();
			$table->integer('ref_id')->unsigned()->nullable();
			$table->string('ref_url', 255)->nullable();
			$table->string('ref_target', 15)->nullable();
			$table->text('media')->nullable();
			$table->text('param')->nullable();
			$table->text('metas')->nullable();
			$table->boolean('in_home')->nullable();
			$table->integer('position')->unsigned()->nullable();
			$table->string('slug', 500);
			$table->boolean('active')->nullable();

			$table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('cms_articles')
                  ->onDelete('cascade');

            $table->foreign('schema_id')
                  ->references('id')
                  ->on('cms_schemas')
                  ->onDelete('cascade');

            $table->foreign('lang_id')
                  ->references('id')
                  ->on('cms_langs')
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
		Schema::drop('cms_articles');
	}

}
