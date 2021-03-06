<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('/companies', 'Api\CompaniesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('/employees', 'Api\EmployeesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
});
 Route::middleware('auth:api')->get('users', function(Request $request) {
     return $request->user();
 });
// Route::get('login', 'Api\LoginController@showLoginForm')->name('login');
Route::post('login', 'Api\LoginController@login')->name('login');
// Route::post('logout', 'Api\LoginController@logout')->name('logout');

// Route::get('/home', 'HomeController@index')->name('home');