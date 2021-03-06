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


Route::middleware('AuthManager')->prefix('/manager')->group(function () {
    Route::resources(
        ['task' => 'ManagerTaskController'],
        ['names' => 'ManagerTask']
    );
});

Route::middleware('AuthDeveloper')->prefix('/developer')->group(function () {
    Route::resources(
        ['task' => 'DeveloperTaskController'],
        ['names' => 'DeveloperTask']
    );
});
