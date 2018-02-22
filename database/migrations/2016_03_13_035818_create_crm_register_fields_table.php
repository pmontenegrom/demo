<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmRegisterFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_register_fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('register_id')->unsigned();
			$table->integer('field_id')->unsigned();
			$table->string('value', 255);
			$table->text('txt_value')->nullable();
			$table->timestamps();

			$table->foreign('register_id')
				  ->references('id')
				  ->on('crm_registers')
				  ->onDelete('cascade');

			$table->foreign('field_id')
				  ->references('id')
				  ->on('crm_form_fields');// ->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_register_fields');
	}

}
