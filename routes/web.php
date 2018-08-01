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


Route::get('/','HomeController@index');
Route::get('/search','HomeController@search');
Route::get('/hash/{hash}','HomeController@hash');

Route::group(['prefix'=>'webAdmin','namespace'=>'Admin'],function(){
    //登陆视图
    Route::get('login','LoginController@index')->name('login');
    //退出登录
    Route::get('logout','LoginController@logout');
    //创建账号
   // Route::get('reg','UserController@createUser');

    Route::group(['middleware' => 'auth'],function (){
        //后台首页视图
        Route::get('index','IndexController@index');
        //后台首页欢迎视图
        Route::get('welcome','IndexController@welcome');
        //广告列表视图
        Route::get('banner','BannerController@index');
        //添加广告视图
        Route::get('banner/add','BannerController@add');
        //广告编辑视图
        Route::get('banner/edit/{id}','BannerController@edit');
        //添加广告逻辑
        Route::post('banner/store','BannerController@store');
        //通知列表视图
        Route::get('notice','NoticeController@index');
        //添加通知视图
        Route::get('notice/add','NoticeController@add');
        //编辑通知视图
        Route::get('notice/edit/{id}','NoticeController@edit');
        //日志列表
        Route::get('log','LogController@index');
        //推荐磁力列表视图
        Route::get('hot','HotController@index');
        //推荐磁力添加视图
        Route::get('hot/add','HotController@add');


    });

});