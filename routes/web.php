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

// Route::get('/' , 'UserController@summary');

Route::get('/newuser', ['as' => 'addnew' , 'uses'=>'UserController@add']);

Route::post('/addnew', 'UserController@addnew1');

Route::get('/user', 'UserController@summary');

Route::get('/edituser/recnum/{recnum}' , ['as' => 'edit_user' , 'uses'=>'UserController@edit']);

Route::post('/update_user', ['as' => 'updateuser' , 'uses'=>  'userController@userupdate']);

Route::get('/deleteuser/recnum/{recnum}', ['as' => 'delete_user' , 'uses'=>  'userController@removeuser']);

Route::get('/' , 'LoginController@index');

Route::post('/loginuser', ['as' => 'checkuser' , 'uses'=>'LoginController@processlogin']);

Route::get('/bom' , 'MasterController@pssummary');

Route::get('/psdetails/recnum/{recnum}' , ['as' => 'ps_details' , 'uses'=>'MasterController@psdetails']);