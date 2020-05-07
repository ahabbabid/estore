<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ProductsController@index');
Route::get('/admin-dashboard', function(){

	return view('admin-dashboard.main');
});
Route::get('/admin-dashboard/add-product', 'ProductsController@getTags');
Route::post('/admin-dashboard/add-product', 'ProductsController@save');
Route::get('/admin-dashboard/add-image', ['as' => 'add-image','uses'=>'ImagesController@get']);
Route::post('/admin-dashboard/add-image', 'ImagesController@save');
Route::get('/images', function(){
	$products= App\Product::all();
	return view('welcome', ['products'=>$products]);
});
Route::get('/admin-dashboard/add-tag', 'TagsController@create');
Route::post('/admin-dashboard/add-tag', 'TagsController@save');