<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
        Route::resource('school', SchoolController::class);
        Route::resource('student', StudentController::class);
        Route::get('/user/{name}', 'App\Http\Controllers\UserController@show');
        Route::group(['prefix' => 'app'], function () {
            Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

        });

});
