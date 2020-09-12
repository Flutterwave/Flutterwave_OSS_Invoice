<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $item
 * @property int $quantity
 * @property float $unit_price
 * @property int $invoice_id
 *
 * @package App\Models\Base
 */
class Item extends Model
{
	protected $table = 'items';
	public $timestamps = false;

	protected $casts = [
		'quantity' => 'int',
		'unit_price' => 'float',
		'invoice_id' => 'int'
	];
}
