<?php

namespace App\Models;

use App\Models\Base\Invoice as BaseInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Invoice extends BaseInvoice
{
    protected $fillable = [
        'ref',
        'currency_id',
        'to_email',
        'cc_emails',
        'customer_id',
        'notes',
        'status',
        'due_date',
        'created_at',
        'paid_at',
        'issued_at',
        'acc_name',
        'bank',
        'acc_num',
        'shipping_fee',
        'discount',
        'tax'
    ];

    // Mutators

    // Accessors
    public function getStatusAttribute($value)
    {
        if (empty($value))
            return null;

        if (Carbon::parse($this->due_date)->lt(Carbon::now()))
            return 'due';

        return $value;
    }

    // Relations

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'invoice_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');
    }

    // Scoped Queries

    public function scopeId($query, $id)
    {
        if (empty($id)) {
            return $query;
        }

        return $query->where('id', DB::raw($id));

    }

    public function scopeEmail($query, $email)
    {
        if (empty($email)) {
            return $query;
        }

        return $query->where('to_email', $email);

    }

    public function scopeStatus($query, $status)
    {
        if (empty($status)) {
            return $query;
        }

        $query = $query->whereIn('status', $status);

        if (in_array('due', $status)) {
            return $query->orWhere(function ($query) {
                $query->where('status', 'issued')
                    ->where('due_date', '<', now()->format('c'));
            });
        }

        return $query;
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
