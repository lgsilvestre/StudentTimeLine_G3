<?php

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
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function(){ 
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('roles', 'RolController@index')->name('rol.index');
    Route::get('users', 'UsersController@index')->name('user.index');
    Route::get('user/{user}/editar', 'UsersController@editDatosPersonales')->name('user.perfil');
});
