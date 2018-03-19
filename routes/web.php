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
Route::post('goals/store-sub', 'GoalController@store_sub');

Route::get('reasons/create/goal/{goal_id}', 'ReasonController@create');
Route::post('reasons', 'ReasonController@store');
Route::delete('reasons/{id}/goal/{goal_id}', 'ReasonController@destroy');

Route::get('efforts/create/goal/{goal_id}', 'EffortController@create');
Route::post('efforts', 'EffortController@store');
Route::get('efforts/{id}', 'EffortController@show');
Route::delete('efforts/{id}/goal/{goal_id}', 'EffortController@destroy');

Route::post('/effort_time/store', 'EffortTimeController@store');
Route::delete('effort_time/{id}', 'EffortTimeController@destroy');
Route::get('/effort_time/{id}', 'EffortTimeController@edit');
Route::post('/effort_time/update', 'EffortTimeController@update');

Route::get('steps/create/goal/{goal_id}', 'StepController@create');
Route::post('steps', 'StepController@store');
Route::delete('steps/{id}/goal/{goal_id}', 'StepController@destroy');
Route::put('steps/{id}', 'StepController@update');

//Route::resource('motivators', 'MotivatorController');
Route::get('motivators/create/goal/{goal_id}', 'MotivatorController@create');
Route::get('motivators/{goal_id}', 'MotivatorController@show');
Route::post('motivators', 'MotivatorController@store');
Route::delete('motivators/{id}/goal/{goal_id}', 'MotivatorController@destroy');

//sleep
Route::get('/sleep', 'SleepController@index');
Route::get('/sleep/{id}', 'SleepController@edit');
Route::post('/sleep/update', 'SleepController@update');
Route::get('/sleep/create', 'SleepController@create');
Route::post('/sleep/store', 'SleepController@store');
Route::delete('sleep/{id}', 'SleepController@destroy');
