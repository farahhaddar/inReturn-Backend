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
Route::post('/logout', 'AuthController@logout');


//******************************************//
//              city   ROUTES               //
//******************************************//
Route::get('/cities', 'CitiesController@index');


//******************************************//
//              offer items  ROUTES         //
//******************************************//
Route::post('/offerItems', 'OfferItemsController@store');

//******************************************//
//              offer    ROUTES             //
//******************************************//
Route::post('/offer','OfferController@store');


//******************************************//
//              Item   ROUTES               //
//******************************************//
Route::get('/items', 'ItemsController@index');
Route::get('/item/{id}', 'ItemsController@show');
Route::post('/item', 'ItemsController@store');
Route::put('item/{id}', 'ItemsController@update');
Route::delete('item/{id}', 'ItemsController@destroy');

//******************************************//
//              Item   ROUTES               //
//******************************************//

Route::get('/categories', 'CategoriesController@index');

//******************************************//
//              Item   ROUTES               //
//******************************************//
Route::get('/wishLists/{id}','WishListController@index');
Route::post('/wishList', 'WishListController@store');
Route::delete('wishList/{id}', 'WishListController@destroy');



// });
