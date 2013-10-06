<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'AdminController@showHome');
Route::get('/login', 'AdminController@loginCms');
Route::post('/login', 'AdminController@loginCms');
Route::get('/logout', 'AdminController@logoutCms');

//users module
Route::get('/admin/users', 'UsersController@main');
Route::post('/admin/users', 'UsersController@main');
Route::get('/admin/users/view_all_users', 'UsersController@main');
Route::post('/admin/users/view_all_users', 'UsersController@main');
Route::get('/admin/users/new_user', 'UsersController@edit');
Route::post('/admin/users/new_user', 'UsersController@edit');
Route::get('/admin/users/edit_user/{id}', 'UsersController@edit');
Route::post('/admin/users/edit_user/{id}', 'UsersController@edit');


//ajax module
Route::post('/ajax/requests', 'AjaxController@dispatcher');
Route::put('/ajax/requests', 'AjaxController@dispatcher');
Route::get('/ajax/requests', 'AjaxController@dispatcher');
Route::delete('/ajax/requests', 'AjaxController@dispatcher');