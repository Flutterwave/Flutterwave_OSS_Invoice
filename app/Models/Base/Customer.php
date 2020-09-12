<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $address
 * @property string|null $city
 * @property string|null $state
 * @property int $country_id
 * @property int $user_id
 * @property string $created_at
 * @property string $deleted_at
 *
 * @package App\Models\Base
 */
class Customer extends Model
{
	use SoftDeletes;
	protected $table = 'customers';
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'country_id' => 'int',
		'user_id' => 'int'
	];
}
