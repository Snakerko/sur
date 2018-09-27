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

Route::match(['get','post'],'/', ['uses' => 'HomeController@execute', 'as' => 'home']); // маршрут личного кабинета

Route::match(['get','post'], '/survey', ['uses' => 'SurveyController@execute', 'as' => 'survey']); // маршрут опроса

Route::post('/report', ['uses'=>'ReportController@execute', 'as'=>'report']);

Route::get('/report/{id}',['uses'=>'AdminController@erase', 'as'=>'delRep']);

Route::group(['prefix'=>'admin'], function () 
{
  Route::match(['get','post'], '/', ['uses' => 'AdminController@execute', 'as' => 'admin']); 
});
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);

Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);

Route::match(['get','post'],'logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Password Reset Routes...
// Route::get('password/reset/{token?}', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm']);
// Route::post('password/email', ['as' => 'password.email', 'uses' => 'ResetPasswordController@sendResetLinkEmail']);
// Route::post('password/reset', ['as' => 'password.update', 'uses' => 'ResetPasswordController@reset']);

//Auth::routes();
