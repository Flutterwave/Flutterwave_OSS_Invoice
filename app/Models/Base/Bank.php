<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bank
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 *
 * @package App\Models\Base
 */
class Bank extends Model
{
	protected $table = 'banks';
	public $timestamps = false;
}
