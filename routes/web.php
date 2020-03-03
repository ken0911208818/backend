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

Route::get('/', 'FrontController@index');
Route::get('/news','FrontController@news');
Route::get('/product','FrontController@product');
Auth::routes();

//prefix=> 共同的路由 用群組的方式可省略不寫 ex /home    >   ex /
Route::group(['middleware' => ['auth'],'prefix'=>'/home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/news', 'NewsController@index');

    //新增與儲存
    Route::get('/news/create', 'NewsController@create');
    Route::post('/news/store', 'NewsController@store');

    //編輯與更新
    Route::get('/news/edit/{id}', 'NewsController@edit');
    Route::post('/news/update/{id}', 'NewsController@update');

    //刪除
    Route::post('/news/delete/{id}', 'NewsController@delete');

    Route::resource('/product', 'ProductController');


});

