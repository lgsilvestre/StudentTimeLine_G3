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

    Route::post('roles/store','RolController@store')->name('roles.store');
       
    Route::get('roles','RolController@index')->name('rol.index');

    Route::get('roles/create','RolController@create')->name('rol.create');

    Route::put('roles/{role}','RolController@update')->name('rol.update');

    Route::get('roles/{role}','RolController@show')->name('rol.show');

    Route::delete('roles/destroy','RolController@destroy')->name('rol.destroy');

    Route::get('roles/{role}/edit','RolController@edit')->name('rol.edit');




    Route::get('users', 'UsersController@index')->name('user.index');
    Route::get('user/{user}/editar', 'UsersController@editDatosPersonales')->name('user.perfil');

});
