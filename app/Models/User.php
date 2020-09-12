<?php

namespace App\Models;

use App\Models\Base\User as BaseUser;
use Carbon\Carbon;

class User extends BaseUser
{
    protected $fillable = [
        'f_name',
        'l_name',
        'phone',
        'email',
        'password',
        'country_id',
        'created_at',
    ];

    public function setCreatedAtAttribute($date)
    {
        $this->attributes['created_at'] = Carbon::parse($date)->format('c');
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value, 'UTF-8');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
