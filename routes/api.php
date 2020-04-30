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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('index', 'api\\IndexController@index');

Route::any('demo', function (){
    header("Access-Control-Allow-Origin:*");
    $arr = [
        [
            'id' => 1,
            'name' => 'one'
        ],
        [
            'id' => 2,
            'name' => 'two'
        ],
        [
            'id' => 3,
            'name' => 'three'
        ],
        [
            'id' => 4,
            'name' => 'four'
        ],
    ];
    return $arr;
});
