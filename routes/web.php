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
Route::get('showAuction/car{car}/category{category}/district{district}', 'AuctionController@showAuctionPage');
Route::post('showAuction/getSellersAndBuyersListInAuction', 'AuctionController@getSellersAndBuyersListInAuction');
Route::post('showAuction/setBuyerChooseSeller', 'AuctionController@setBuyerChooseSeller');
Route::post('showAuction/removeBuyerChoise', 'AuctionController@removeBuyerChoise');
Route::post('showAuction/finishAuctionAndShowContactPage', 'AuctionController@finishAuctionAndShowContactPage');
Route::get('showAuction/finishAuctionAndShowContactPage', 'AuctionController@finishAuctionAndShowContactPage');
Route::post('showAuction/setNewPrice', 'AuctionController@setNewPrice');
Route::post('getGoods', 'HomeController@getGoods');
Route::post('getAuctionsForGood', 'HomeController@getAuctionsForGood');
Route::post('getMyClosedAuctions', 'AuctionController@getMyClosedAuctions');
Route::post('showAuction/partnerContacts',
             'AuctionController@goToPartnerContactsPage');

Route::get('showAuction/partnerContacts',
            'AuctionController@goToPartnerContactsPage');

Route::post('showAuction/my_wins', 'AuctionController@showMyAuctions');
Route::post('/my_wins', 'AuctionController@showMyAuctions');
Route::get('showAuction/my_wins', 'AuctionController@showMyAuctions');
Route::get('/my_wins', 'AuctionController@showMyAuctions');
Route::post('showAuction/setBuyerAccepted', 'AuctionController@setBuyerAccepted');

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

