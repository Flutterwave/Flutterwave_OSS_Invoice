<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * 
 * @property int $id
 * @property string $email
 * @property string $token
 * @property Carbon $created_at
 * @property int $used
 *
 * @package App\Models\Base
 */
class PasswordReset extends Model
{
	protected $table = 'password_resets';
	public $timestamps = false;

	protected $casts = [
		'used' => 'int'
	];
}
