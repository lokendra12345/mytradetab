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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


/* User Login, Register */
Route::post('/login/', 'api\v1\AuthController@login');
Route::post('/register/', 'api\v1\AuthController@register');

Route::group(['middleware' => 'auth:api'], function(){

 	/* User Login  show , update, dashboard */
 	Route::get('/get/{id}', 'api\v1\AuthController@get');
 	Route::put('/update/{id}', 'api\v1\AuthController@update');
 	Route::get('/dashboard/{id}', 'api\v1\AuthController@dashboard');

 	/* business routes */
 	Route::post('business/register', 'api\v1\Business\BusinessController@register');
 	Route::get('business/show/{id}', 'api\v1\Business\BusinessController@show');
	Route::put('business/update/{id}', 'api\v1\Business\BusinessController@update');

	/* category routes */
	Route::post('category/create', 'api\v1\Category\CategoryController@create');
	Route::get('category/show/{id}', 'api\v1\Category\CategoryController@show');
	Route::put('category/update/{id}', 'api\v1\Category\CategoryController@update');
	Route::put('category/destroy/{id}', 'api\v1\Category\CategoryController@destroy');

	/* product routes */
	Route::post('product/store', 'api\v1\Product\ProductController@store');
	Route::get('product/show/{id}', 'api\v1\Product\ProductController@show');
	Route::put('product/update/{id}', 'api\v1\Product\ProductController@update');
	Route::put('product/destroy/{id}', 'api\v1\Product\ProductController@destroy');

});

