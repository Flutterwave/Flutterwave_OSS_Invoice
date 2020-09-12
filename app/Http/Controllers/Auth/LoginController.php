<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\Master;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'bail|required|string',
        ]);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $response = [
                'user' => Auth::user()
            ];
            return Master::successResponse('Login successful', $response);
        } else {
            return Master::failureResponse('Username/Password is incorrect');
        }
    }

    public function user(Request $request)
    {
        return Master::successResponse('success', Auth::user());
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return Master::successResponse('Logout successful');
    }

}
