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

Route::get('/admin-login', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/donator', 'Auth\LoginController@showDonatorLoginForm');
Route::get('/login/manager', 'Auth\LoginController@showManagerLoginForm');
Route::get('/login/pickerman', 'Auth\LoginController@showPickermanLoginForm');
Route::get('/login/verifier', 'Auth\LoginController@showVerifierLoginForm');

Route::get('/register/donator', 'Auth\RegisterController@showDonatorRegisterForm');
Route::get('/register/manager', 'Auth\RegisterController@showManagerRegisterForm');
Route::get('/register/pickupman', 'Auth\RegisterController@showPickupmanRegisterForm');
Route::get('/register/verifier', 'Auth\RegisterController@showVerifierRegisterForm');

Route::post('/adminlogin', 'Auth\LoginController@adminLogin')->name('adminlgn');
Route::post('/login/donator', 'Auth\LoginController@donatorLogin');
Route::post('/login/manager', 'Auth\LoginController@managerLogin');
Route::post('/login/pickerman', 'Auth\LoginController@pickermanLogin');
Route::post('/login/verifier', 'Auth\LoginController@verifierLogin');

Route::post('/register/donator', 'Auth\RegisterController@createDonator');
Route::post('/register/manager', 'Auth\RegisterController@createManager');
Route::post('/register/pickupman', 'Auth\RegisterController@createPickupman');
Route::post('/register/verifier', 'Auth\RegisterController@createVerifier');

//Route::view('/home', 'home')->middleware('auth');

Route::view('/admin', 'admin.dashboard');
Route::view('/donator', 'donator');
Route::view('/manager', 'manager');
Route::view('/pickupman', 'pickupman');
Route::view('/verifier', 'verifier');
