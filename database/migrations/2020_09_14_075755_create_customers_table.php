<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('email');
			$table->string('phone')->nullable();
			$table->string('address');
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->smallInteger('country_id');
			$table->integer('user_id');
			$table->string('created_at');
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customers');
	}

}
