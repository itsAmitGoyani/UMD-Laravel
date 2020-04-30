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
//Route::resource('admin','AdminsController');
//multimuthenticate route
Route::view('/donator', 'donator');
Route::view('/manager', 'manager');
Route::view('/pickupman', 'pickupman');
Route::view('/verifier', 'verifier');

Route::get('/login/donator', 'Auth\LoginController@showDonatorLoginForm');
// Route::get('/login/manager', 'Auth\LoginController@showManagerLoginForm');
Route::get('/login/pickerman', 'Auth\LoginController@showPickermanLoginForm');
Route::get('/login/verifier', 'Auth\LoginController@showVerifierLoginForm');

Route::get('/register/donator', 'Auth\RegisterController@showDonatorRegisterForm');
Route::get('/register/pickupman', 'Auth\RegisterController@showPickupmanRegisterForm');
Route::get('/register/verifier', 'Auth\RegisterController@showVerifierRegisterForm');

Route::post('/login/donator', 'Auth\LoginController@donatorLogin');
// Route::post('/login/manager', 'Auth\LoginController@managerLogin');
Route::post('/login/pickerman', 'Auth\LoginController@pickermanLogin');
Route::post('/login/verifier', 'Auth\LoginController@verifierLogin');

Route::post('/register/donator', 'Auth\RegisterController@createDonator');
Route::post('/register/pickupman', 'Auth\RegisterController@createPickupman');
Route::post('/register/verifier', 'Auth\RegisterController@createVerifier');



//Route::view('/home', 'home')->middleware('auth');

// All routes with admin prefix and uses by admin only

//Route::get('/admin-dashboard', 'AdminController@index');
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


//manager routes

//All routes with manager prefix and uses by manager only

Route::group(['prefix' => 'manager'], function () {
    Route::group(['middleware' => ['auth:manager']], function () {
        Route::get('/', 'ManagerController@showdashboard');
    });
    Route::get('login', 'Auth\LoginController@showManagerLoginForm');
    Route::post('login', 'Auth\LoginController@managerLogin')->name('manager-login');
    Route::get('logout', 'Auth\LogoutController@managerLogout');
});
