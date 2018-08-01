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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix'=>'webAdmin','namespace'=>'Admin'],function(){
    //登陆逻辑
    Route::post('login','LoginController@store');

    Route::group(['middleware' => 'auth'],function (){
        //删除广告
        Route::post('banner/delete','BannerController@delete');
        //批量删除广告
        Route::post('banner/deleteAll','BannerController@deleteAll');
        //添加通知
        Route::post('notice/add','NoticeController@store');
        //删除指定通知
        Route::get('notice/delete/{id}','NoticeController@delete');
        //批量删除通知
        Route::post('notice/deleteAll','NoticeController@deleteAll');
        //添加推荐磁力
        Route::post('hot/add','HotController@store');
        //删除指定推荐磁力
        Route::get('hot/delete/{id}','HotController@delete');
        //批量删除
        Route::post('hot/deleteAll','HotController@deleteAll');

    });

});