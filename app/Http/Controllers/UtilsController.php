<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\CardType;
use App\Models\City;
use App\Models\ConflictReason;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\ExponentPushNotificationInterest;
use App\Models\OrderStatus;
use App\Models\SystemPref;
use App\Models\TransactionType;
use App\Models\TransCompany;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class UtilsController extends Controller
{
    private static $self;

    public static function boot()
    {
        if (UtilsController::$self)
            return UtilsController::$self;

        UtilsController::$self = new UtilsController();
        return UtilsController::$self;
    }

    public function fetchCountries()
    {

        $countries = Country::get();

        $countries = $countries->map(function ($item, $key) {
            return [
                'label' => $item->name,
                'value' => $item->id
            ];
        });

        return [
            'status' => true,
            'countries' => $countries
        ];
    }

    public function fetchCurrencies()
    {

        $currencies = Currency::get();

        $currencies = $currencies->map(function ($item, $key) {
            return [
                'label' => $item->name,
                'value' => $item->iso
            ];
        });

        return [
            'status' => true,
            'currencies' => $currencies
        ];
    }

    public function fetchCustomers()
    {

        $customers = Customer::where('user_id', Auth::id())->get();

        $customers = $customers->map(function ($item, $key) {
            return [
                'label' => "$item->email ($item->name)",
                'value' => $item->email
            ];
        });

        return [
            'status' => true,
            'customers' => $customers
        ];
    }

    public function fetchBanks()
    {
        $banks = Bank::get();

        $banks = $banks->map(function ($item, $key) {
            return [
                'label' => $item->name,
                'value' => $item->name
            ];
        });

        return [
            'status' => true,
            'banks' => $banks
        ];
    }

    public function verifyAccountNumber(Request $request)
    {
        $res = Http::withToken(config('services.flutterwave.secret'))
            ->post('https://api.flutterwave.com/v3/accounts/resolve',
                [
                    "account_number" => $request->acc_num,
                    "account_bank" => Bank::where('name', $request->bank)->first()->code
                ]);

        if ($res->successful()) {
            return [
                'status' => true,
                'acc_name' => $res->json()['data']['account_name']
            ];
        }

        return [
            'status' => false,
            'msg' => 'Account not resolved',
            'data' => $res->json()
        ];
    }

}
