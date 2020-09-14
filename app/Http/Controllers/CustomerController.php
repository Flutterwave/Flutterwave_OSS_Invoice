<?php

namespace App\Http\Controllers;

use App\Library\Master;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a filtered listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $date_range = json_decode($request->date_range);

        try {
            $customers = Customer::with(['country'])
                ->id($request->id)
                ->email($request->email)
                ->phone($request->phone)
                ->userId(Auth::id())
                ->dateFrom($date_range->from ?? null)
                ->dateTo($date_range->to ?? null)
                ->orderBy('created_at', 'desc');

            if ($request->export)
                $customers = $customers->get();
            else
                $customers = $customers->paginate($request->per_page);

//        $this->transformCustomer($customers);

            return Master::successResponse('Fetched successfully', $customers);
        } catch (\Exception $exception) {
            if (Master::hasDebug())
                return Master::exceptionResponse($exception, 'Filter Customers');
            return Master::failureResponse();
        }
    }

    private function transformCustomer($customers)
    {
        $customers->transform(function ($customer, $key) {
//            $amount = $customer->items->sum('unit_price');
//
//            $customer->total_amt = $this->to2dp($amount);;
            return $customer;
        });
    }

    private function to2dp($number)
    {
        return number_format((float)$number, 2, '.', ',');
    }

    public function fetchCustomer($id)
    {
        $customer = Customer::id($id)
            ->get();

        if ($customer) {
//            $this->transformCustomer($customer);
//            $customer = Arr::collapse($customer->toArray());
            return Master::successResponse('Fetched successfully', $customer);
        }

        return Master::failureResponse('Customer not found');

    }

    public function editCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'bail|sometimes|integer',
            'name' => 'bail|required|string',
            'email' => 'bail|required|email',
            'phone' => 'bail|nullable|string',
            'address' => 'bail|nullable|string',
            'city' => 'bail|nullable|string',
            'state' => 'bail|nullable|string',
            'country_id' => 'bail|nullable|integer',
        ]);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }

        try {
            DB::beginTransaction();

            $customer = (Customer::find($request->id)) ?? new Customer;

            $customer->name = $request->name ?? $customer->name;
            $customer->email = $request->email ?? $customer->email;
            $customer->phone = $request->phone ?? $customer->phone;
            $customer->address = $request->address ?? $customer->address;
            $customer->city = $request->city ?? $customer->city;
            $customer->state = $request->state ?? $customer->state;
            $customer->country_id = $request->country_id ?? $customer->country_id;
            $customer->user_id = $request->user_id ?? Auth::id();
            $customer->created_at = now()->format('c') ?? $customer->created_at;

            $customer->save();

            DB::commit();
            $response = [
                'customer' => $customer
            ];
            return Master::successResponse('Customer created successfully', $response);

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Edit Customer');
            }
            return Master::failureResponse();
        }


    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        try {
            DB::beginTransaction();

            $customer->delete();

            DB::commit();
            return Master::successResponse('Customer deleted successfully');

        } catch (\Exception $exception) {
            DB::rollBack();
            if (Master::hasDebug()) {
                return Master::exceptionResponse($exception, 'Delete Customer');
            }
            return Master::failureResponse();
        }


    }


}

