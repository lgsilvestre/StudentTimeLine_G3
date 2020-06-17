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

    Route::get('home', 'CarreraController@index')->name('home');

    Route::post('roles/store','RolController@store')->name('rol.store')
    ->middleware('has.role:admin');
       
    Route::get('roles/index','RolController@index')->name('rol.index')
    ->middleware('has.role:admin');

    Route::get('roles/create','RolController@create')->name('rol.create')
    ->middleware('has.role:admin');

    Route::put('roles/{role}','RolController@update')->name('rol.update')
    ->middleware('has.role:admin');

    Route::get('roles/{role}','RolController@show')->name('rol.show')
    ->middleware('has.role:admin');

    Route::post('roles.destroy','RolController@destroy')->name('rol.destroy')
    ->middleware('has.role:admin');

    Route::get('roles/{role}/edit','RolController@edit')->name('rol.edit')
    ->middleware('has.role:admin');

    //Usuarios rutas
    Route::get('users','UsersController@index')->name('users.index')
    ->middleware('has.role:admin');

    Route::post('users/update','UsersController@update')->name('users.update')->middleware('has.role:admin');

    Route::get('users/{user}','UsersController@show')->name('users.show')
    ->middleware('has.role:admin');

    Route::get('users/{user}/edit','UsersController@edit')->name('users.edit')
    ->middleware('has.role:admin');

    Route::get('usersdisable','UsersController@indexDisable')->name('users.disable')
    ->middleware('has.role:admin');
    
    Route::post('users/store','UsersController@store')->name('users.store')
    ->middleware('has.role:admin');

    Route::post('users/destroy','UsersController@destroy')->name('users.destroy')
    ->middleware('has.role:admin');

    Route::post('users/restore','UsersController@restore')->name('users.restore')
    ->middleware('has.role:admin');

    Route::get('user/{user}/', 'UsersController@editDatosPersonales')->name('user.perfil');

    Route::post('categoria/store','CategoriaController@store')->name('categoria.store')
    ->middleware('has.role:admin');

    Route::get('categoria/index','CategoriaController@index')->name('categoria.index')
    ->middleware('has.role:admin');
    
    Route::get('categoria/create','CategoriaController@create')->name('categoria.create')
    ->middleware('has.role:admin');

    Route::post('categoria/update','CategoriaController@update')->name('categoria.update')
    ->middleware('has.role:admin');

    Route::get('categoria/{categoria}','CategoriaController@show')->name('categoria.show')
    ->middleware('has.role:admin');

    Route::post('categoria.destroy','CategoriaController@destroy')->name('categoria.destroy')
    ->middleware('has.role:admin');

    Route::get('categoria/{categoria}/edit','CategoriaController@edit')->name('categoria.edit')
    ->middleware('has.role:admin');

    //rutas de modulos
    Route::get('modulo/index','Modulo_carreraController@index')->name('modulo.index')
    ->middleware('has.role:admin');

    Route::post('modulodestroy','Modulo_carreraController@destroy')->name('modulo.destroy')
    ->middleware('has.role:admin');

    Route::post('modulo/store','Modulo_carreraController@store')->name('modulo.store')
    ->middleware('has.role:admin');

    Route::post('modulo/update','Modulo_carreraController@update')->name('modulo.update')
    ->middleware('has.role:admin');

    //Rutas de estudiantes
    Route::get('estudiantes/{carrera}/','EstudianteController@index')->name('estudiantes.index');
});
