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
Route::group(['middleware'=>['admin']],function(){
    Route::get('/','DashboardController@index')->name('dashboard');
    
});

/** Category routes start */

Route::group(['middleware'=>['admin']],function(){
    Route::get('/categories','CategoryController@index')->name('task_category.index');
    Route::get('/categories/create','CategoryController@create')->name('task_category.create');
    Route::post('/categories/store','CategoryController@store')->name('task_category.store');
    Route::get('/categories/{id}/edit','CategoryController@edit')->name('task_category.edit');
    Route::post('/categories/{id}/update','CategoryController@update')->name('task_category.update');
    Route::delete('/categories/{id}/delete','CategoryController@destroy')->name('task_category.delete');
});

/** Category routes end */

/** Task routes start */

Route::group(['middleware'=>['admin']],function(){
    Route::get('/tasks/ongoing','TaskController@index')->name('task.ongoing');
    Route::get('/tasks/pending','TaskController@pending')->name('task.pending');
    Route::get('/tasks/completed','TaskController@completed')->name('task.completed');
    Route::get('/tasks/create','TaskController@create')->name('task.create');
    Route::post('/tasks/store','TaskController@store')->name('task.store');
    Route::get('/tasks/{id}/edit','TaskController@edit')->name('task.edit');
    Route::post('/tasks/{id}/update','TaskController@update')->name('task.update');
    Route::delete('/tasks/{id}/delete','TaskController@destroy')->name('task.delete');
    Route::post('/tasks/{id}/completed','TaskController@makeCompleted')->name('task.make_completed');
    Route::post('/tasks/{id}/pending','TaskController@makePending')->name('task.make_pending');
});

/** Task routes end */

/** Project routes start */


/** Project routes end */

/** Project Tasks routes start */



/** Project Tasks routes end */

/** Authentication routes start */

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login','AuthController@login')->name('auth.login');
    Route::post('/login','AuthController@authenticate')->name('auth.authenticate');
    Route::get('/register','RegistrationController@register')->name('auth.register');
    Route::post('/register','RegistrationController@create')->name('auth.registration');
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/logout','AuthController@logout')->name('auth.logout');
});

/** Authentication routes end */