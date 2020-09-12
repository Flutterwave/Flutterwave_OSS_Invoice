<?php

namespace App\Models;

use App\Models\Base\Customer as BaseCustomer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Customer extends BaseCustomer
{
	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'city',
		'state',
		'country_id',
		'user_id',
        'created_at'
	];
	protected $appends = ['full_address'];

    // Mutators

    // Accessors
    public function getFullAddressAttribute()
    {
        return "$this->address, $this->city, $this->state, " . $this->country->name;
    }

    // Relations

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    // Scoped Queries

    public function scopeId($query, $id)
    {
        if (empty($id)) {
            return $query;
        }

        return $query->where('id', DB::raw($id));

    }

    public function scopeUserId($query, $id)
    {
        if (empty($id)) {
            return $query;
        }

        return $query->where('user_id', DB::raw($id));

    }

    public function scopeEmail($query, $email)
    {
        if (empty($email)) {
            return $query;
        }

        return $query->where('email', $email);

    }

    public function scopePhone($query, $phone)
    {
        if (empty($phone)) {
            return $query;
        }

        return $query->where('phone', $phone);

    }

    public function scopeDateFrom($query, $dateFrom)
    {
        if (empty($dateFrom)) {
            return $query;
        }

        $dateFrom = Carbon::parse($dateFrom)->format('c');

        return $query->where('created_at', '>=', $dateFrom);
    }

    public function scopeDateTo($query, $dateTo)
    {
        if (empty($dateTo)) {
            return $query;
        }

        $dateTo = Carbon::parse($dateTo)->addDays(1)->format('c');

        return $query->where('created_at', '<', $dateTo);
    }
}
