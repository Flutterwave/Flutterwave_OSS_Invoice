<?php

namespace App\Models;

use App\Models\Base\Currency as BaseCurrency;

class Currency extends BaseCurrency
{
    protected $fillable = [
        'name',
        'iso'
    ];

    public function scopeIso($query, $iso)
    {
        if (empty($iso))
            return;

        return $query->where('iso', $iso);

    }
}
