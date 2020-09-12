<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reminder
 * 
 * @property int $id
 * @property string $date
 * @property int $invoice_id
 * @property string $created_at
 *
 * @package App\Models\Base
 */
class Reminder extends Model
{
	protected $table = 'reminders';
	public $timestamps = false;

	protected $casts = [
		'invoice_id' => 'int'
	];
}
