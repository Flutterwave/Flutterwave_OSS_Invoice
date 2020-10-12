<?php
/**
 * @copyright Flutterwave Technology
 * @author Salvation Arinze <salvation@flutterwavego.com>
 * @version 1.0.0
 * @website: https://www.flutterwavego.com
 * @github https://github.com/salvationarinze
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'Flutterwave Invoices — OSS';
});

Route::namespace('Auth')->prefix('auth')->group(function () {
    Route::post('/login', 'LoginController@authenticate');
    Route::post('/user/register', 'RegisterController@createUser');
//    Route::get('/user', 'LoginController@user');
    Route::post('/logout', 'LoginController@logout');

    Route::post('/resetPassword', 'ResetPasswordController@sendResetLink')
        ->name('send-reset-link');
    Route::post('/updatePassword', 'ResetPasswordController@setPassword');;
});

Route::prefix('utils')->group(function () {
    Route::get('fetchCountries', 'UtilsController@fetchCountries');
    Route::get('fetchCurrencies', 'UtilsController@fetchCurrencies');
    Route::get('fetchCustomers', 'UtilsController@fetchCustomers');
    Route::get('verifyAccountNumber', 'UtilsController@verifyAccountNumber');
});

Route::middleware(['auth:sanctum'])
    ->group(function () {
        // Invoice
        Route::get('invoices/filter', 'InvoiceController@filter');
        Route::get('invoice/fetchInvoiceFormOptions', 'InvoiceController@fetchFormOptions');
        Route::get('invoice/{id}', 'InvoiceController@fetchInvoice');
        Route::post('invoice/edit/{id?}', 'InvoiceController@editInvoice');
        Route::delete('invoice/{id}', 'InvoiceController@deleteInvoice');
        Route::post('invoice/{id}/markAsPaid', 'InvoiceController@markAsPaid');
        Route::post('invoice/{id}/downloadInvoice', 'InvoiceController@downloadInvoice');
        Route::post('invoice/{id}/sendInvoice', 'InvoiceController@sendInvoice');

        //Customers
        Route::get('customers/filter', 'CustomerController@filter');
        Route::get('customer/{id}', 'CustomerController@fetchCustomer');
        Route::post('customer/edit/{id?}', 'CustomerController@editCustomer');
        Route::delete('customer/{id}', 'CustomerController@deleteCustomer');

    });
