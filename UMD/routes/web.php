<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/donator', 'Auth\LoginController@showDonatorLoginForm');
Route::get('/register/donator', 'Auth\RegisterController@showDonatorRegisterForm');
Route::post('/login/donator', 'Auth\LoginController@donatorLogin');
Route::post('/register/donator', 'Auth\RegisterController@createDonator');
Route::post('/register/pickupman', 'Auth\RegisterController@createPickupman');
Route::post('/register/verifier', 'Auth\RegisterController@createVerifier');

// All routes with admin prefix and uses by admin only

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('login', 'Auth\LoginController@showAdminLoginForm');
    Route::post('login', 'Auth\LoginController@adminLogin')->name('admin-login');
    Route::get('registerngo', 'NgosController@create');
    Route::post('registerngo', 'NgosController@store')->name('admin-registerngo');
    Route::get('displayngos', 'NgosController@index')->name('admin-displayngos');
    Route::get('ngos/{ngo_id}/edit', 'NgosController@edit');
    Route::put('ngos/{id}', 'NgosController@update');
    Route::delete('ngos/{id}', 'NgosController@destroy');

    Route::get('registermanager', 'Auth\RegisterController@showManagerRegisterForm');
    Route::post('registermanager', 'Auth\RegisterController@createManager')->name('admin-registermanager');
    Route::get('displaymanagers', 'ManagerController@index')->name('admin-displaymanagers');
    Route::get('managers/{ngo_id}/edit', 'ManagerController@edit');
    Route::put('managers/{id}', 'ManagerController@update');
    Route::delete('managers/{id}', 'ManagerController@destroy');

    Route::get('logout', 'Auth\LogoutController@adminLogout');
});


Route::group(['prefix'=>'ngo'],function(){
    Route::get('/',function () {
        return view('ngo.home');
    });
    //All routes with manager prefix and uses by manager only
    Route::group(['prefix' => 'manager'], function () {
        Route::group(['middleware' => ['auth:manager']], function () {
            Route::get('/', 'ManagerController@showdashboard');
            Route::get('logout', 'Auth\LogoutController@managerLogout');

            Route::get('registerpickupman', 'Auth\RegisterController@showPickupmanRegisterForm')->name('RegisterPickupman');
            Route::post('registerpickupman', 'Auth\RegisterController@createPickupman')->name('RegisterPickupman');
            Route::get('displaypickupmen', 'PickupmanController@index')->name('DisplayPickupmen');
            Route::get('pickupmen/{id}/edit', 'PickupmanController@edit');
            Route::put('pickupmen/{id}', 'PickupmanController@update');
            Route::delete('pickupmen/{id}', 'PickupmanController@destroy');
        });
        Route::get('login', 'Auth\LoginController@showManagerLoginForm');
        Route::post('login', 'Auth\LoginController@managerLogin')->name('manager-login');
        
    });

    //All routes with pickupman prefix and uses by pickupman only
    Route::group(['prefix' => 'pickupman'], function () {
        Route::group(['middleware' => ['auth:pickupman']], function () {
            Route::get('/', 'PickupmanController@showDashboard');
            Route::get('logout', 'Auth\LogoutController@pickupmanLogout');

        });
        Route::get('login', 'Auth\LoginController@showPickupmanLoginForm');
        Route::post('login', 'Auth\LoginController@pickupmanLogin')->name('pickupman-login');
        
    });
});

