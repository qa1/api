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
$version_1 = "api/v1";

Route::get('/', function () {
    return view('welcome');
});

// App v1 API
Route::group(['prefix' => $version_1], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/skill', 'SkillController@index');
    Route::get('/user', 'UserController@index');
    Route::post('/token', 'AuthenticationController@generateToken');
    Route::get('/category', 'CategoryController@index');
    Route::post('/category', 'CategoryController@store');
    Route::get('/search/{uuid}', 'SearchController@search');
    Route::get('/connection', 'ConnectionController@index');
});

Route::group(array('prefix' => $version_1, 'middleware' => ['jwt.user.auth']), function () {
    Route::put('/user/{uuid}', 'UserController@update');
    Route::get('/user/{uuid}', 'UserController@getUser');
    Route::delete('/user/{uuid}', 'UserController@deleteUser');
    Route::get('/user/{uuid}/info', 'UserController@getUserInfo');
    Route::get('/user/{uuid}/skill', 'UserController@getUserSkill');
    Route::post('/user/{uuid}/skill', 'UserController@addUserSkill');
    Route::put('/user/{uuid}/skill', 'UserController@editUserSkill');
    Route::delete('/user/{uuid}/skill/{user_skill_uuid}', 'UserController@deleteUserSkill');

    Route::post('/user/{uuid}/connection', 'ConnectionController@store');
    Route::get('/user/{uuid}/connection', 'ConnectionController@getConnection');
    Route::delete('/user/{uuid}/connection/{connection_uuid}', 'ConnectionController@delete');
    Route::put('/user/{uuid}/connection/{connection_uuid}', 'ConnectionController@editConnection');

    Route::get('/about', 'AboutController@index');
    Route::post('/about', 'AboutController@store');
});

