<?php

namespace App\Models;

use App\Models\Base\Reminder as BaseReminder;

class Reminder extends BaseReminder
{
	protected $fillable = [
		'date',
		'invoice_id'
	];
}
