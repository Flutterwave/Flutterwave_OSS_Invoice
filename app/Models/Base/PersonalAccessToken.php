<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalAccessToken
 * 
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property string|null $abilities
 * @property Carbon|null $last_used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class PersonalAccessToken extends Model
{
	protected $table = 'personal_access_tokens';
	public $timestamps = false;

	protected $casts = [
		'tokenable_id' => 'int'
	];

	protected $dates = [
		'last_used_at'
	];
}
