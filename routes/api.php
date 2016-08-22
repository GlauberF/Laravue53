<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/bills', ['as' => 'bills.index', 'uses' => 'BillController@index']);
Route::post('/bills', ['as' => 'bill.new', 'uses' => 'BillController@store']);
Route::put('/bills/{id}', ['as' => 'bill.update', 'uses' => 'BillController@update']);
Route::put('/bills/{id}/pay', ['as' => 'bill.pay', 'uses' => 'BillController@pay']);
Route::put('/bills/{id}/unpay', ['as' => 'bill.unpay', 'uses' => 'BillController@unpay']);
Route::delete('/bills/{id}', ['as' => 'bill.destroy', 'uses' => 'BillController@destroy']);