<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $f_name
 * @property string $l_name
 * @property string $email
 * @property string|null $phone
 * @property int $country_id
 * @property Carbon $created_at
 * @property string $deleted_at
 *
 * @package App\Models\Base
 */
class User extends Authenticatable
{

    use Notifiable, HasApiTokens;
    use SoftDeletes;

    protected $table = 'users';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'country_id' => 'int'
    ];

    protected $hidden =[
        'password'
    ];

}
