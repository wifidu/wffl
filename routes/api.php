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

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function () {
    // 短信验证码
    Route::post('verificationCodes', 'VerificationCodesController@store')
        ->name('verificationCodes.store');
    Route::post('users', 'UsersController@store')
        ->name('users.store');
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) { */
/*     return $request->user(); */
/* }); */

/* Route::prefix('v1')->name('api.v1.')->group(function(){ */
/*     Route::get('version', function(){ */
/*         return 'this is version v1'; */
/*     })->name('version'); */
/* }); */
