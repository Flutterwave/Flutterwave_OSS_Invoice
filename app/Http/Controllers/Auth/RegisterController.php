<?php

namespace App\Http\Controllers\Auth;

use App\Library\Master;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

//    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'bail|required|string',
            'l_name' => 'bail|required|string',
            'phone' => 'bail|nullable|unique:users,phone',
            'country' => 'bail|required|integer|exists:countries,id',
            'email' => 'bail|required|string|email|unique:users,email',
            'password' => 'bail|required|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'password' => $request->password,
                'created_at' => now()->format('c')
            ]);

            $user->notify(new WelcomeEmail($user->f_name));

            DB::commit();
            $response = [
                'user' => $user
            ];
            return Master::successResponse('Registration Successful', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug())
                return Master::exceptionResponse($exception, 'Register User');
            return Master::failureResponse();
        }
    }
}
