<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\Master;
use App\Models\Admin;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\PasswordReset;
use App\Models\TransCompany;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email'
        ]);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }

        $user = User::where('email', '=', $request->email)
            ->first();

        //Check if the user exists
        if (!$user) {
            return Master::failureResponse('User not found');
        }
        //Create Password Reset Token
        $reset_info = PasswordReset::create([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        if ($this->sendResetEmail($user, $reset_info->token)) {
            return Master::successResponse('Reset email sent');
        } else {
            return Master::failureResponse();
        }
    }

    private function sendResetEmail($user, $token)
    {
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('app.url') . '/password/reset/' . $token .
            '?email=' . urlencode($user->email);

        try {
            $user->notify(new ForgotPassword($user->f_name, $link));

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function setPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:4|confirmed',
            'password_confirmation' => 'bail|required',
            'token' => 'bail|required'
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'meta' => 'validation_error',
                'error' => $validator->errors()->first()
            ];
        }

        try {
            $reset_info = PasswordReset::where('email', $request->email)
                ->where('token', $request->token)
                ->where('used', \DB::raw(0))->first();

            if (blank($reset_info)) {
                return [
                    'status' => false,
                    'meta' => 'invalid_token'
                ];
            }

            $user = User::where('email', '=', $request->email)->first();

            $user->password = $request->password;
            $user->save();

            $reset_info->used = 1;
            $reset_info->save();

            return ['status' => true];

        } catch (\Exception $e) {
            Log::emergency($e->getMessage(), ['data' => $e]);
            if (Master::hasDebug())
                return Master::exceptionResponse($e, 'Reset Password');
        }
        Log::critical('Sever Error Occurred', ['module' => 'Reset Password']);
        return Master::failureResponse();
    }
}
