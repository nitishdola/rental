<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', 'HomeController@index');


//Login Routes...
Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');
Route::post('/admin/login','AdminAuth\AuthController@login');
Route::get('/admin/logout',['uses' => 'AdminAuth\AuthController@logout', 'as' => 'admin.logout']);

Route::get('/admin',['uses' => 'AdminAuth\AuthController@showDashboard', 'middleware' => 'admin', 'as' => 'admin_dashboard'] );

Route::group(['prefix'=>'unit'], function() {
    Route::get('/create', [
        'as' => 'unit.create',
        'middleware' => ['admin'],
        'uses' => 'UnitsController@create'
    ]);

    Route::post('/store', [
        'as' => 'unit.store',
        'middleware' => 'admin',
        'uses' => 'UnitsController@store'
    ]);

    Route::get('/view-all', [
        'as' => 'unit.index',
        'middleware' => 'admin',
        'uses' => 'UnitsController@index'
    ]);

    Route::get('/edit/{num}', [
        'as' => 'unit.edit',
        'middleware' => 'admin',
        'uses' => 'UnitsController@edit'
    ]);

    Route::post('/update/{num}', [
        'as' => 'unit.update',
        'middleware' => 'admin',
        'uses' => 'UnitsController@update'
    ]);
});

Route::group(['prefix'=>'renter'], function() {
    Route::get('/create', [
        'as' => 'renter.create',
        'middleware' => ['admin'],
        'uses' => 'RentersController@create'
    ]);

    Route::post('/store', [
        'as' => 'renter.store',
        'middleware' => 'admin',
        'uses' => 'RentersController@store'
    ]);

    Route::get('/view-all', [
        'as' => 'renter.index',
        'middleware' => 'admin',
        'uses' => 'RentersController@index'
    ]);

    Route::get('/edit/{num}', [
        'as' => 'renter.edit',
        'middleware' => 'admin',
        'uses' => 'RentersController@edit'
    ]);

    Route::post('/update/{num}', [
        'as' => 'renter.update',
        'middleware' => 'admin',
        'uses' => 'RentersController@update'
    ]);
});
