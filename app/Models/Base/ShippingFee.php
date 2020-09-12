<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShippingFee
 * 
 * @property int $id
 * @property string $name
 * @property string $amount
 * @property string|null $desc
 * @property int $user_id
 *
 * @package App\Models\Base
 */
class ShippingFee extends Model
{
	protected $table = 'shipping_fees';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];
}
