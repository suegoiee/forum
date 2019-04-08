<?php

//use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//API
Route::namespace('API')->group(function () {
    Route::post('register', 'Auth\RegisterController@register')->name('api.register.post');
    Route::get('register', 'Auth\RegisterController@register')->name('api.register.get');

    Route::get('user/verified', 'Auth\VerifiedUserController@verified')->name('api.verified.post');
    Route::post('user/verified', 'Auth\VerifiedUserController@verified')->name('api.verified.post');
});