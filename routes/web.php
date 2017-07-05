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

/*Route::get('/', function () {
    //return view('welcome');
});*/

Route::model('category', App\Category::class);
Route::get('/', 'CategoryController@showAllCategories');
Route::get('sell{category}', 'CategoryController@showSellForm');
Route::get('buy{category}', 'CategoryController@showBuyForm');
Route::post('addCategoryGood{category}', 'CategoryController@saveNewGoodAndShowCategory');
Route::post('addCategoryOrder{category}', 'CategoryController@saveNewOrderAndShowCategory');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
