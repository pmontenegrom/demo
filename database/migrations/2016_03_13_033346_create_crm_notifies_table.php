<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmNotifiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crm_notifies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('recipients')->nullable();
			$table->boolean('active')->nullable();
			$table->timestamps();

			$table->foreign('form_id')
				  ->references('id')
				  ->on('crm_forms')
				  ->onDelete('cascade');

			$table->foreign('user_id')
				  ->references('id')
				  ->on('users')
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
		Schema::drop('crm_notifies');
	}

}
