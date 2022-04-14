<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'UserController@index');

// User Registration 
Route::post('add-user', 'UserController@addUser')->name('add.user');

// Delete User
Route::post('delete-user', 'UserController@deleteUser');         

// Get selected user data
Route::get('selected-user','UserController@getSelectedUser');

Route::post('update-user','UserController@updateUser');

// Update user Status
Route::post('update-status','UserController@updateUserStatus');
