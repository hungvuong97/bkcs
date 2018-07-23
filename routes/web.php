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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dangnhap','Usercontroller@getLogin');
Route::post('dangnhap','Usercontroller@postLogin');

Route::get('addAccount','Usercontroller@getAddAccount');
Route::post('addAccount','Usercontroller@postAddAccount');
Route::get('accountList','Usercontroller@getAccountList');
Route::get('deviceList','Usercontroller@getDeviceList');
Route::get('editAccount/{adminId}','Usercontroller@getEditAccount');
Route::post('editAccount/{adminId}','Usercontroller@postEditAccount');
Route::get('manageDevice','Usercontroller@getManageDevice');
//Route::post('manageDevice','Usercontroller@postmanageDevice');

Route::get('/home', 'HomeController@index')->name('home');
