<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('admin',['middleware' => 'auth', 'uses' => 'Admin\HomeController@index']);
Route::get('admin/home/notfound',['middleware' => 'auth', 'uses' => 'Admin\HomeController@notfound']);
Route::get('admin/home/permission',['middleware' => 'auth', 'uses' => 'Admin\HomeController@permission']);

Auth::routes();

Route::group(['middleware' => ['auth', 'admin'], 'prefix'=>'admin', 'namespace'=>'Admin'], function(){

    Route::resource('user', 'UserController');
    Route::resource('webuser', 'WebUserController');
    Route::resource('article', 'ArticleController');
    Route::resource('profile', 'ProfileController');
    Route::resource('log', 'LogController');
    Route::resource('lang', 'LangController');
    Route::resource('translate', 'TranslateController');
    Route::resource('config', 'ConfigController');
    Route::resource('schema', 'SchemaController');
    Route::resource('directory', 'DirectoryController');
    Route::resource('register', 'RegisterController');
    Route::resource('notify', 'NotifyController');
    Route::resource('parameter', 'ParameterController');

    Route::post('article/sort', 'ArticleController@sort');
    Route::post('schema/sort', 'SchemaController@sort');
});


Route::get('/',['uses' => 'FrontController@index']);
Route::get('/index.html',['uses' => 'FrontController@index']);

Route::get('/ajax/form/refresh_captcha', 'Ajax\FormController@refereshCaptcha');
Route::post('/ajax/form/post',['uses' => 'Ajax\FormController@store']);

Route::get('/intranet/login',['uses' => 'FrontController@login']);
Route::post('/intranet/login',['uses' => 'FrontController@authenticate']);
//Route::get('/intranet/{pages}', array('uses' => 'FrontController@intranet'))->where('pages', '.*');

Route::get('{slug?}', array('uses' => 'FrontController@page'))->where('slug', '.*');
