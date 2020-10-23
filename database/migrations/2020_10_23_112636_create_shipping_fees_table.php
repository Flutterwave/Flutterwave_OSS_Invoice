<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingFeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipping_fees', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('amount');
			$table->string('desc')->nullable();
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shipping_fees');
	}

}
