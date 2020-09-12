<?php


namespace App\Http\Controllers\Traits;


trait Utils
{
    function roundNum($num, $nearest)
    {
        return round($num / $nearest) * $nearest;
    }

    function calcTnxFee($amount)
    { // including 0.75 VAT
        $amount = floatval($amount);
        if ($amount < 5000) {
            return 10 + (0.075 * 10);
        } else if ($amount < 50000) {
            return 25 + (0.075 * 25);
        } else {
            return 50 + (0.075 * 50);
        }
    }

    function calcWthTax($amount_exp, $amount_inv, $tenure)
    { // including 0.75 VAT
        $actual_interest = ($amount_exp - $amount_inv) / $tenure;
        return 0.1 * $actual_interest;
    }
}