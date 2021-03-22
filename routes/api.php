<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::post('/forgot', 'ForgotPasswordController@sendPasswordResetEmail');
Route::post('/reset', 'ForgotPasswordController@reset');

// Route::group(['middleware' => ['jwt.verify']], function() {

   //******************************************//
  //              USER   ROUTES               //
 //******************************************//
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user', 'UserController@store');
Route::put('/user/{id}', 'UserController@update');
Route::delete('/user/{id}', 'UserController@destroy');
Route::get('/usersNb', 'UserController@count');


//******************************************//
//              city   ROUTES               //
//******************************************//
Route::get('/cities', 'CitiesController@index');





// });
