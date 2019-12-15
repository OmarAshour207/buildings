<?php

// Admin Routes
Route::group(['prefix'  => 'adminpanel'], function (){
    Config::set('auth.defines', 'admin');

    Route::get('login', 'AdminAuth@login');
    Route::post('login', 'AdminAuth@doLogin');
    Route::get('forgot/password', 'AdminAuth@forgot_password');
    Route::post('forgot/password', 'AdminAuth@forgot_password_post');
    Route::get('reset/password/{token}', 'AdminAuth@reset_password');
    Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');

    Route::group(['middleware'  => 'admin:admin'], function (){

//        Route::get('/', 'AdminController@homePage');
        Route::get('building/year/statistics', 'AdminController@showYearStatistics');
        Route::post('building/year/statistics', 'AdminController@showThisYear');
        Route::resource('/', 'AdminController');

        Route::get('users/data', [ 'as'   => 'users.data', 'uses' => 'UserController@anyData'] );
        Route::resource('users', 'UserController');
//        Route::get('user/{id}/buildings', 'UserController@userBuildings');

        Route::resource('settings', 'SettingController');

        Route::get('buildings/data', [ 'as' => 'buildings.data', 'uses' => 'BuildingController@anyData']);
        Route::resource('buildings', 'BuildingController', ['except' => ['index', 'show']]);
        Route::get('buildings/{id?}', 'BuildingController@index');

        Route::get('change_status/{id}/{status_value}', 'BuildingController@updateStatusValue');

        Route::get('contacts/data', [ 'as' => 'contacts.data', 'uses' => 'ContactController@anyData']);
        Route::resource('contacts', 'ContactController');

        Route::any('logout' , 'AdminAuth@logout');

        //rss
        Route::get('generate_rss', 'User/HomeController@generateRss');
    });
});
