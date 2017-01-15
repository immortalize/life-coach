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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('goals', 'GoalController');
//Route::resource('goal.reason', 'ReasonController');
Route::resource('efforts', 'EffortController');

Route::get('goal/associate/select-sub/{parent_goal_id}', 'GoalController@select_sub');
Route::post('goal/associate/store-sub/{parent_goal_id}/sub/{sub_goal_id}', 'GoalController@associate_sub');

/*
 *  create a goas as a sub goal
 */
Route::get('goal/create-sub/{parent_goal_id}', 'GoalController@create_sub');
Route::post('goals/store-sub/{parent_goal_id}', 'GoalController@store_sub');

Route::get('reasons/create/goal/{goal_id}', 'ReasonController@create');
Route::post('reasons', 'ReasonController@store');
Route::delete('reasons/{id}/goal/{goal_id}', 'ReasonController@destroy');