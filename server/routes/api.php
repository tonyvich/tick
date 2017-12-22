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

Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	
	// Project route
	Route::get( '/projects/{column}/{order}', 'API\ProjectController@get_user_projects' )->name( 'projects.all' );
	Route::get( '/project/{id}/{task_column}/{task_order}', 'API\ProjectController@view' )->name( 'project.view' );
	Route::post( '/project', 'API\ProjectController@create' )->name( 'project.create' );
	Route::put( '/project', 'API\ProjectController@update' )->name( 'project.update' );
	
	// Task route
	Route::post( '/tasks', 'API\TaskController@create' )->name( 'task.create' );
	Route::put( '/tasks', 'API\TaskController@update' )->name( 'task.update' );
	Route::put( '/complete_task/{id}', 'API\TaskController@completed' )->name( 'task.completed' );
	Route::put( '/uncomplete_task/{id}', 'API\TaskController@uncompleted' )->name( 'task.uncompleted' );
	
	// User route
	Route::get( '/users', 'API\UserController@users' )->name( 'user.index' );
	Route::put( '/role_edit', 'API\UserController@role_edit' )->name( 'user.role_edit' );
	Route::put( '/password_edit', 'API\UserController@role_edit' )->name( 'user.password_edit' );
	Route::get('/details', 'API\UserController@details')->name( 'user.details' );
});