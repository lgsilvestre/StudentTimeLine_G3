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

    Route::post('roles/store','RolController@store')->name('roles.store')
    ->middleware('has.role:admin');
       
    Route::get('roles','RolController@index')->name('rol.index')
    ->middleware('has.role:admin');

    Route::get('roles/create','RolController@create')->name('rol.create')
    ->middleware('has.role:admin');

    Route::put('roles/{role}','RolController@update')->name('rol.update')
    ->middleware('has.role:admin');

    Route::get('roles/{role}','RolController@show')->name('rol.show')
    ->middleware('has.role:admin');

    Route::delete('roles/destroy','RolController@destroy')->name('rol.destroy')
    ->middleware('has.role:admin');

    Route::get('roles/{role}/edit','RolController@edit')->name('rol.edit')
    ->middleware('has.role:admin');

    //Usuarios rutas
    Route::get('users','UsersController@index')->name('users.index')
    ->middleware('has.role:admin');

    Route::put('users/{user}/edit','UsersController@update')->name('users.update')
    ->middleware('has.role:admin');

    Route::get('users/{user}','UsersController@show')->name('users.show')
    ->middleware('has.role:admin');

    Route::get('users/{user}/update','UsersController@edit')->name('users.edit')
    ->middleware('has.role:admin');

    Route::get('userscreate','UsersController@create')->name('users.create')
    ->middleware('has.role:admin');

    Route::get('users/{user}/store','UsersController@edit')->name('users.store')
    ->middleware('has.role:admin');

    Route::get('user/{user}/editarPersonal', 'UsersController@editDatosPersonales')->name('user.perfil');

});
