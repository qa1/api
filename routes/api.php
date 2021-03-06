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

Route::post('v1/token', 'AuthenticationController@generateToken');


/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| contain routes that use in admin application & only account with type=10 has access to them. 
|
 */
Route::group(array('prefix' => 'v1', 'middleware' => ['jwt.admin.auth']), function () {
    Route::post('/category', 'CategoryController@store');
    Route::put('/category/{uuid}', 'CategoryController@update');
    Route::delete('/category/{uuid}', 'CategoryController@delete');

    Route::post('/category/{uuid}/skill', 'CategoryController@storeSkill');
    Route::put('/skill/{uuid}', 'SkillController@update');
    Route::delete('/skill/{uuid}', 'SkillController@delete');

    Route::post('/about', 'AboutController@store');

    Route::get('/connection', 'ConnectionController@index');

    Route::get('/skill', 'SkillController@index');

    Route::get('/user', 'UserController@index');
});
/*
|--------------------------------------------------------------------------
| User Web Routes
|--------------------------------------------------------------------------
|
| contain routes that require token for access to them.
|
 */
Route::group(array('prefix' => 'v1', 'middleware' => ['jwt.user.auth']), function () {
    Route::get('/category', 'CategoryController@index');

    //User routes
    Route::put('/user/{uuid}', 'UserController@update');
    Route::get('/user/{uuid}', 'UserController@getUser');
    Route::delete('/user/{uuid}', 'UserController@deleteUser');
    Route::get('/user/{uuid}/info', 'UserController@getUserInfo');
    Route::put('/user/{uuid}/firebase', 'UserController@setFirebaseId');

    //UserSkill routes
    Route::get('/user/{uuid}/skill', 'UserController@getUserSkill');
    Route::post('/user/{uuid}/skill', 'UserController@addUserSkill');
    Route::put('/user/{uuid}/skill', 'UserController@editUserSkill');
    Route::delete('/user/{uuid}/skill/{user_skill_uuid}', 'UserController@deleteUserSkill');

    //Search route
    Route::get('/search/{uuid}', 'SearchController@search');

    //Connection routes
    Route::post('/user/{uuid}/connection', 'ConnectionController@store');
    Route::get('/user/{uuid}/connection', 'ConnectionController@getConnection');
    Route::delete('/user/{uuid}/connection/{connection_uuid}', 'ConnectionController@delete');
    Route::put('/user/{uuid}/connection/{connection_uuid}', 'ConnectionController@editConnection');

    //About route
    Route::get('/about', 'AboutController@index');

});
