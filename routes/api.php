<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    /* Users */
    Route::get('users','\App\User\Controllers\APIController@index')->name('users.index');
    Route::get('users/me','\App\User\Controllers\APIController@me')->name('users.me');

    /* Communities */
    Route::get('communities','\App\Estate\Controllers\APIController@index')->name('community.index');
    Route::get('communities/me','\App\Estate\Controllers\APIController@me')->name('community.me');

    /* Units */
    Route::get('units','\App\Estate\Controllers\UnitAPIController@index')->name('unit.index');
    Route::get('units/{id}','\App\Estate\Controllers\UnitAPIController@show')->name('unit.show');
});