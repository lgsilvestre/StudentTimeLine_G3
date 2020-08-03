<?php

use Illuminate\Support\Facades\Route;
use App\Exports\RangoEstudianteExport;


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
    Route::get('recordatorio/', function () {
        return view('Usuario.recordatorio');
    })->name('users.recordatorio');

    Route::post('/obtcarrera','UsersController@obtcarrera')->name('obtcarrera');

    Route::get('home/', 'CarreraController@index')->name('home');

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

    Route::get('users/{user}/edit','UsersController@edit')->name('users.edit')
    ->middleware('has.role:admin');

    Route::get('usersdisable','UsersController@indexDisable')->name('users.disable')
    ->middleware('has.role:admin');
    
    Route::post('users/storeusers','UsersController@store')->name('users.store')
    ->middleware('can:addUser');
    Route::post('users/store','UsersController@store_Profesor')->name('users.store_profesor')
    ->middleware('can:addUser');

    //rutas de imagen, test
    Route::post('user/image','UsersController@postProfileImage')->name('users.postProfileImage');

    Route::post('users/destroy','UsersController@destroy')->name('users.destroy')
    ->middleware('has.role:admin');

    Route::post('users/restore','UsersController@restore')->name('users.restore')
    ->middleware('has.role:admin');

    Route::get('user/{user}/', 'UsersController@editDatosPersonales')->name('user.perfil');

    Route::post('users/updatecontrasena','UsersController@updateContrasena')->name('users.updatecontrasena');
    //rutas de categorias
    Route::post('categoria/store','CategoriaController@store')->name('categoria.store')
    ->middleware('can:categoria.index');

    Route::get('categoria/index','CategoriaController@index')->name('categoria.index')
    ->middleware('can:categoria.index');
    
    Route::get('categoria/create','CategoriaController@create')->name('categoria.create')
    ->middleware('can:categoria.index');

    Route::post('categoria/update','CategoriaController@update')->name('categoria.update')
    ->middleware('can:categoria.index');

    Route::get('categoria/{categoria}','CategoriaController@show')->name('categoria.show')
    ->middleware('can:categoria.index');

    Route::post('categoria.destroy','CategoriaController@destroy')->name('categoria.destroy')
    ->middleware('can:categoria.index');

    Route::get('categoria/{categoria}/edit','CategoriaController@edit')->name('categoria.edit')
    ->middleware('can:categoria.index');

    //rutas de modulos
    Route::get('modulo/index','Modulo_carreraController@index')->name('modulo.index')
    ->middleware('can:modulos.index');

    Route::post('modulodestroy','Modulo_carreraController@destroy')->name('modulo.destroy')
    ->middleware('can:modulos.index');

    Route::post('modulo/store','Modulo_carreraController@store')->name('modulo.store')
    ->middleware('can:modulos.index');

    Route::post('modulo/update','Modulo_carreraController@update')->name('modulo.update')
    ->middleware('can:modulos.index');

    //Rutas de estudiantes
    Route::get('estudiantes/{carrera}/','EstudianteController@index')->name('estudiantes.index');

    Route::post('estudiantes/{carrera}/store','EstudianteController@store')->name('estudiante.store')
    ->middleware('has.role:admin');
    
    Route::post('estudiante/{estudiante}/update','EstudianteController@update')->name('estudiante.update')
    ->middleware('has.role:admin');

    Route::get('estudiante/{estudiante}/', 'EstudianteController@show')->name('estudiante.show');

    
    //ruta para excel
    Route::post('estudiantes/{carrera}/importExcel','EstudianteController@importExcel')->name('estudiante.import.excel')
    ->middleware('has.role:admin');


    //Rutas de carreras

    Route::post('carrera/store','CarreraController@store')->name('carrera.store')
    ->middleware('has.role:admin');

    Route::post('carrera/destroy','CarreraController@destroy')->name('carrera.destroy')
    ->middleware('has.role:admin');

    Route::post('carrera/update','CarreraController@update')->name('carrera.update')
    ->middleware('has.role:admin');

    //Rutas de Observacion
    Route::post('observacion/{estudiante}/store','ObservacionController@store')->name('observacion.store');

    Route::post('observacion/{estudiante}/update','ObservacionController@update')->name('observacion.update');

    Route::post('observacion/{estudiante}/destroy','ObservacionController@destroy')->name('observacion.destroy');

    //ruta para enviar correo recordatorios
    Route::post('enviarcorreos/','UsersController@enviarRecordatorio')->name('enviarrecordatorio');

    Route::post('exportarrango/','EstudianteController@exportarRangoFechas')->name('exportrango');
});
