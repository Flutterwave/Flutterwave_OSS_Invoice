<?php

namespace App\Models;

use App\Models\Base\Bank as BaseBank;

class Bank extends BaseBank
{
	protected $fillable = [
		'name',
		'code'
	];
}
