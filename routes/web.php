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
Route::view('/', 'welcome')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('fallos', 'FallosController@store')->name('fallos.store');

Auth::routes();

Route::group([
    //'prefix' => 'admin',
    //'namespace' => 'Admin',
    'middleware' => 'auth'
], function(){
    Route::get('/escritorio', 'HomeController@index')->name('admin.index');
    Route::post('/categorias', 'CategoriaController@store')->name('categorias.store');
});