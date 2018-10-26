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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Usuarios
Route::get('/usuarios', 'UsuariosController@index');

//Roles
Route::get('/permisologia', 'PermisologiaController@index');
Route::post('/saveRol', 'PermisologiaController@storeRol');
Route::post('/savePermission', 'PermisologiaController@storePermission');
Route::get('/role/edit/{id}', 'PermisologiaController@editRole')->name('edit');
Route::post('/updateRole/{id}', 'PermisologiaController@updateRole');
Route::get('/role/delete/{id}', 'PermisologiaController@deleteRole')->name('delete');
Route::get('/permission/edit/{id}', 'PermisologiaController@editPermission')->name('editPermission');
Route::post('/updatePermission/{id}', 'PermisologiaController@updatePermission');
Route::get('/role/user/edit/{id}', 'UsuariosController@editUserRol')->name('editUserRol');
Route::post('/updateUserRol/{id}', 'UsuariosController@updateUserRol');
Route::get('/registro', 'RegistroController@index');