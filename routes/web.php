<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* Route::get('/', function () {
    return redirect('/home');
}); */
Route::view('/', 'spa')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('fallos', 'FallosController@store')->name('fallos.store');
Auth::routes();

Route::group([
    //'prefix' => 'admin',
    //'namespace' => 'Admin',
    'middleware' => 'auth'
], function(){
    Route::get('/escritorio', 'HomeController@index')->name('admin.index');
    Route::get('/categorias', 'CategoriaController@index')->name('categorias.index');
    Route::post('/categorias', 'CategoriaController@store')->name('categorias.store');
    Route::put('/categorias/update/{categoria}', 'CategoriaController@update')->name('categorias.update');
    Route::delete('/categorias/{categoria}', 'CategoriaController@destroy')->name('categorias.destroy');
});

//Aliases para pruebas en consola
// doskey pu="vendor/bin/phpunit"
// doskey du=php artisan dusk
// php artisan dusk tests/Browser/UsuarioPuedeEliminarCategoriasTest.php

// php artisan make:test EliminarCategoriasTest
// php artisan dusk:make UsuarioPuedeEliminarCategoriasTest

//https://www.5balloons.info/laravel-tdd-beginner-crud-example/
