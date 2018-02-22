<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmFormFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_form_fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->string('name', 255);
			$table->string('alias', 255);
			$table->string('type', 15);
			$table->text('options')->nullable();
			$table->boolean('active')->nullable();
			$table->timestamps();

			$table->foreign('form_id')
				  ->references('id')
				  ->on('crm_forms')
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
		Schema::drop('crm_form_fields');
	}

}
