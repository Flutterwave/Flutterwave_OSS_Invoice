<?php


namespace App\Traits;


use Carbon\Carbon;

trait ConvertDateTrait
{
    private function convertToLocalDate($date)
    {
        $_date = null;

        if (is_int($date)) $_date = Carbon::createFromTimestamp($date, 'America/Los_Angeles');
        else $_date = Carbon::parse($date, 'America/Los_Angeles');

        return $_date->setTimezone('Africa/Lagos')->toDateTimeString();
    }

    private function convertToServerDate($date)
    {
        $_date = null;

        if (is_int($date)) $_date = Carbon::createFromTimestamp($date, 'Africa/Lagos');
        else $_date = Carbon::parse($date, 'Africa/Lagos');

        return $_date->setTimezone('America/Los_Angeles')->toDateTimeString();
    }

    private function convertToServerTimestamp($timestamp)
    {
        $timestamp_ = null;

        if (is_int($timestamp)) $timestamp_ = Carbon::createFromTimestamp($timestamp, 'Africa/Lagos');
        else $timestamp_ = Carbon::parse($timestamp, 'Africa/Lagos');

         return  $timestamp_->setTimezone('America/Los_Angeles')->timestamp;
    }


}