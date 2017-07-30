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
Route::model('car', App\Car::class);
Route::model('district', App\District::class);

Route::get('/', 'CategoryController@showAllGoodTypes');
Route::get('buildingMaterials', function(){ return view('chooseSelectionType');});
Route::get('chooseCar', 'CarController@showAllCarModel');
Route::get('chooseCategory', 'CategoryController@showAllCategories');
Route::get('chooseCarAfterCategory{category}', 'CarController@showAllCarModel');
Route::get('chooseCategoryAfterCar{car}', 'CategoryController@showAllCategories');
Route::get('chooseDistrictAndSetPrice/car{car}/category{category}', 'AuctionController@showAllDistricts');
Route::post('goToSelectedAuction/car{car}/category{category}', 'AuctionController@goToAuction');
Route::get('goToSelectedAuction/car{car}/category{category}', 'AuctionController@goToAuction');
Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('showAuction/car{car}/category{category}/district{district}', 'AuctionController@showAuction');
Route::get('showAuction/car{car}/category{category}/district{district}', 'AuctionController@showAuctionPage');
Route::post('showAuction/getSalersAndBuyersListInAuction', 'AuctionController@getSalersAndBuyersListInAuction');
Route::post('showAuction/setNewPrice', 'AuctionController@setNewPrice');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::get('sell{category}', 'CategoryController@showSellForm');
Route::get('buy{category}', 'CategoryController@showBuyForm');
Route::post('addCategoryGood{category}', 'CategoryController@saveNewGood');
Route::post('addCategoryOrder{category}', 'CategoryController@saveNewOrder');
//Route::get('categoryAuction{category}', 'CategoryController@showCategoryAuction');
//Route::post('categoryAuction{category}', 'CategoryController@showCategoryAuction');
Route::get('userProfile', 'CategoryController@showUserProfile');
Route::post('userProfile', 'CategoryController@showUserProfile');
Route::get('showAuction/category/{category}/car/{car}/district/{district}', 'CategoryController@showAuction');

