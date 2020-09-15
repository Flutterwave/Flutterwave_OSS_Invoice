<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'app');
Auth::routes();
Route::view('/verified', 'email_verified');
Route::view('/password/reset/{token}', 'auth.passwords.reset', [
    'email' => request()->input('email')
]);

Route::view('{all}', 'app')
    ->where(['all' => '^(?!api).*$']);
