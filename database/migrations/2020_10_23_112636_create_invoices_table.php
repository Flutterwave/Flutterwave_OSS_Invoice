<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ref')->nullable();
			$table->integer('currency_id');
			$table->string('to_email');
			$table->text('cc_emails', 65535)->nullable();
			$table->integer('customer_id')->nullable();
			$table->text('notes', 65535)->nullable();
			$table->string('status');
			$table->string('due_date');
			$table->string('acc_name');
			$table->string('bank');
			$table->string('acc_num');
			$table->decimal('shipping_fee', 10)->nullable()->default(0.00);
			$table->decimal('discount', 10)->nullable()->default(0.00);
			$table->decimal('tax', 10)->nullable()->default(0.00);
			$table->integer('user_id');
			$table->string('paid_at')->nullable();
			$table->string('issued_at')->nullable();
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
		Schema::drop('invoices');
	}

}
