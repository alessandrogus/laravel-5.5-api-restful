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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', ['as' => 'register', 'uses' => 'RegisterController@index']);

Route::group(['namespace' => 'Articles', 'prefix' => '/articles', 'middleware' =>['auth:api']], function() {
	Route::get('/', ['as' => 'articles', 'uses' => 'ArticleController@index']);
	Route::put('/', ['as' => 'articles.store', 'uses' => 'ArticleController@store']);
	Route::get('/{article}', ['as' => 'articles.show', 'uses' => 'ArticleController@show']);	
	Route::post('/{article}', ['as' => 'articles.update', 'uses' => 'ArticleController@update']);	
	Route::delete('/{article}', ['as' => 'articles.delete', 'uses' => 'ArticleController@destroy']);
});