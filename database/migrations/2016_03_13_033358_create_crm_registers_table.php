<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmRegistersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_registers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->integer('contact_id')->nullable();
			$table->string('first_name', 255)->nullable();
			$table->string('last_name', 255)->nullable();
			$table->string('dni', 255)->nullable();
			$table->string('address', 255)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('comments', 4000)->nullable();
			$table->boolean('checkin')->nullable();
			$table->boolean('review')->nullable();
			$table->dateTime('review_date', 255)->nullable();
			$table->timestamps();

			$table->foreign('form_id')
				  ->references('id')
				  ->on('crm_forms');// ->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crm_registers');
	}

}
