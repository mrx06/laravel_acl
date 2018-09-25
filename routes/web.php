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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('user/register', 'Auth\RegisterController@registration')->name('user.registration');
Route::resource('user', 'Authentification\UserController');
Route::post('user/add_role/{id}', 'Authentification\UserController@addRole')->name('user.add_role');
Route::get('user/remove_role/{id}', 'Authentification\UserController@removeRole')->name('user.remove_role');
