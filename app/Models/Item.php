<?php

namespace App\Models;

use App\Models\Base\Item as BaseItem;

class Item extends BaseItem
{
	protected $fillable = [
		'item',
		'quantity',
		'unit_price',
		'invoice_id'
	];
}
