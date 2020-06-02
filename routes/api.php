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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//회원간 메세지 정보 불러올때 사용
Route::group(['prefix' => 'messages'], function () {
    //기록 불러올때
    Route::get('/', 'ChatmessageController@index');
    //메세지 저장할때
    Route::post('/', 'ChatmessageController@store');
});

//회원정보 채팅리스트 불러올때사용
Route::get('users', 'UserController@index');