<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @package App\Models\Base
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;
}
