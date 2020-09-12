<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13-Apr-18
 * Time: 10:46 AM
 */

namespace App\Http\Utils;

use App\Http\Utils\Traits\Send;
use GuzzleHttp\Client;

class SMSUtil
{
    use Send;

    private static $client;
    private static $url;

    public static function boot($user)
    {
        $endpoint = '';

        if (stripos($user, 'borrow') !== false)
            $endpoint = 'borrow';
        else if (stripos($user, 'lend') !== false)
            $endpoint = 'lend';
        else if (stripos($user, 'asset') !== false)
            $endpoint = 'asset';

        $self = new SMSUtil();
        $self::$client = new Client([
            'headers' => [
                'X-API-KEY' => config('app.fint_api_key'),
                'Client-Passcode' => config('app.fint_api_passcode')
            ]
        ]);
        $self::$url = config('app.live_api_url') . "$endpoint/Sms";
        return $self;
    }

    private function setBorrParams($sms_type, $params)
    {
        $params_ = [];

        switch ($sms_type) {
            case 'reg':
                $params_['borrower_id'] = $params[0] ;
                break;
            case 'bor_disburse':
            case 'inv_disburse':
            case 'all_inv_payback':
            case 'all_inv_payback_wallet':
            case 'bor_payback':
            case 'all_inv_repaid':
                $params_['loan_id'] = $params[0];
                break;
            case 'inv_payback':
            case 'inv_payback_wallet':
            case 'inv_repaid':
                $params_['note_id'] = $params[0];
                break;
            case 'general':
                $params_['borrower_id'] = $params[0];
                $params_['message'] = $params[1];
        }

        return $params_;
    }

    private function setInvParams($sms_type, $params)
    {
        $params_ = [];

        switch ($sms_type) {
            case 'reg':
                $params_['investor_id'] = $params[0] ;
                break;
            case 'loan_inv':
                $params_['investor_id'] = $params[0];
                $params_['loan_id'] = $params[0];
                break;
            case 'asset_inv':
                $params_['investor_id'] = $params[0];
                $params_['asset_id'] = $params[0];
                break;
            case 'general':
                $params_['investor_id'] = $params[0];
                $params_['message'] = $params[2];
        }

        return $params_;
    }

    private function setAssetParams($sms_type, $params)
    {
        $params_ = [];

        switch ($sms_type) {
            case 'asset_payback':
            case 'asset_payback_wallet':
                $params_['asset_inv_id'] = $params[0];
                $params_['amt_expected'] = $params[1];
                $params_['withholding_tax'] = $params[2];
                break;
        }

        return $params_;
    }

}