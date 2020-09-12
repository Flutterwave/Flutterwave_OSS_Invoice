<?php

namespace App\Models;

use App\Models\Base\ShippingFee as BaseShippingFee;

class ShippingFee extends BaseShippingFee
{
	protected $fillable = [
		'name',
		'amount',
		'desc',
		'user_id'
	];
}
