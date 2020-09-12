<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property string $iso
 *
 * @package App\Models\Base
 */
class Currency extends Model
{
	protected $table = 'currencies';
	public $timestamps = false;
}
