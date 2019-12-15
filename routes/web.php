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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('all_buildings/{name?}', 'User\BuildingController@showAllBuildings');
Route::get('rent/{name?}', 'User\BuildingController@showRent');
Route::get('buy/{name?}', 'User\BuildingController@showBuy');
Route::get('type/{type_id}/{name?}', 'User\BuildingController@showType');

Route::get('search/{name?}', 'User\BuildingController@showAdvancedSearch');

Route::get('building/{id}/{name?}', 'User\BuildingController@showSingleBuilding');

Route::get('contact', 'User\BuildingController@showContact');

Route::resource('store', 'User\UserController');
//Route::get('user/buildings', 'User\UserController@showUserBuildings');

Route::group(['middleware'  => 'auth', 'namespace' => 'User'], function (){
    Route::get('user/unproved/stores', 'UserController@showUnprovedBuildings');
    // User Profile
    Route::get('user/profile', 'ProfileController@userDataInfo');
    Route::put('user/profile',['as' => 'user.profile', 'uses' => 'ProfileController@updateUserDataInfo']);
    Route::post('user/profile','ProfileController@updateUserPassword')->name('user.password');

    // edit on unproved buildings
    Route::get('edit/building/{id}', 'BuildingController@showEditBuilding');
    Route::put('edit/building/{id}', 'BuildingController@editUnprovedBuilding');

    //rss
    Route::get('/rss', 'HomeController@rss');
});
