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

Route::get('/', ['uses' => 'AdminAuth\AuthController@showDashboard', 'middleware' => 'admin']);


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

    Route::get('/unit-details', [
        'as' => 'renter.unit.info',
        'middleware' => 'admin',
        'uses' => 'RentersController@unit_details'
    ]);

    Route::get('/disable/{num}', [
        'as' => 'renter.disable',
        'middleware' => 'admin',
        'uses' => 'RentersController@delete'
    ]);

    Route::get('/view-bill/{num}', [
        'as' => 'renter.view_bill',
        'middleware' => 'admin',
        'uses' => 'RentersController@view_bill'
    ]);



    Route::get('/view-previous-bills/{num}', [
        'as' => 'renter.view_previous_bill',
        'middleware' => 'admin',
        'uses' => 'RentersController@view_previous_bill'
    ]);

    Route::get('/count-units', [
        'as' => 'renter.count_units',
        //'middleware' => 'admin',
        'uses' => 'RentersController@count_units'
    ]);
});

Route::group(['prefix'=>'bill'], function() {
    Route::get('/create', [
        'as' => 'bill.create',
        'middleware' => ['admin'],
        'uses' => 'BillsController@create'
    ]);

    Route::post('/store', [
        'as' => 'bill.store',
        'middleware' => 'admin',
        'uses' => 'BillsController@store'
    ]);

    Route::get('/view/{num}', [
        'as' => 'bill.view',
        'middleware' => 'admin',
        'uses' => 'BillsController@view'
    ]);


    Route::get('/view-all', [
        'as' => 'bill.index',
        'middleware' => 'admin',
        'uses' => 'BillsController@index'
    ]);

    Route::get('/edit/{num}', [
        'as' => 'bill.edit',
        'middleware' => 'admin',
        'uses' => 'BillsController@edit'
    ]);

    Route::post('/update/{num}', [
        'as' => 'bill.update',
        'middleware' => 'admin',
        'uses' => 'BillsController@update'
    ]);

    Route::get('/disable/{num}', [
        'as' => 'bill.disable',
        'middleware' => 'admin',
        'uses' => 'BillsController@delete'
    ]);

    Route::post('/pay', [
        'as' => 'bill.pay',
        'middleware' => 'admin',
        'uses' => 'BillPaymentsController@make_payment'
    ]);

    Route::get('/report', [
        'as' => 'bill.report_search',
        'middleware' => 'admin',
        'uses' => 'BillPaymentsController@report_search'
    ]);

    Route::get('/report-search-result', [
        'as' => 'bill.report_search_result',
        'middleware' => 'admin',
        'uses' => 'BillPaymentsController@report_search_result'
    ]);
    Route::get('/electricity/all/{renter_id}', [
        'as' => 'electricity.all_bills',
        'middleware' => 'admin',
        'uses' => 'BillsController@all_electricity_bills'
    ]); 
    Route::post('/electricity/bill/pay', [
        'as' => 'electricity_bill.pay',
        'middleware' => 'admin',
        'uses' => 'BillsController@electricity_bill_pay'
    ]);
    Route::get('/electricity/receipt/{ids}', [
        'as' => 'electricity.receipt',
        'middleware' => 'admin',
        'uses' => 'BillsController@electricity_bill_receipt'
    ]); 
    
});


Route::group(['prefix'=>'bill-payments'], function() {
    Route::get('/create-bill', [
        'as' => 'bill_payment.create',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@create_bill'
    ]);

    Route::post('/generate-bill', [
        'as' => 'bill_payment.generate',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@generate_bill'
    ]);

    Route::get('/electricity-bill/view-renters', [
        'as' => 'bill_payment.electricity.view_renters',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@electricity_bill_view_renters'
    ]);
    Route::post('/electricity-bill/view-electricity-bill', [
        'as' => 'bill_payment.electricity_bill_pay',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@electricity_bill_pay'
    ]);


    Route::get('/rent-bill/view-renters', [
        'as' => 'bill_payment.rent.view_renters',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@rent_bill_view_renters'
    ]);
    Route::post('/rent-bill/view-renters-bill', [
        'as' => 'bill_payment.rent_bill_pay',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@rent_bill_pay'
    ]);

    Route::get('/create-bill', [
        'as' => 'bill_payment.create',
        'middleware' => ['admin'],
        'uses' => 'BillPaymentsController@create_bill'
    ]);

    Route::get('/view-rent-bill-receipt/{num}', [
        'as' => 'renter.renter_bill_receipt',
        'middleware' => 'admin',
        'uses' => 'BillPaymentsController@renter_bill_receipt'
    ]);

    Route::get('/notification', [
        'as' => 'renter.notification',
        'middleware' => 'admin',
        'uses' => 'BillPaymentsController@create_notification'
    ]);
});


Route::group(['prefix'=>'electricity-unit'], function() {
    Route::get('/create', [
        'as' => 'electricity_units.create',
        'middleware' => ['admin'],
        'uses' => 'ElectricityUnitsController@create'
    ]);

    Route::post('/store', [
        'as' => 'electricity_units.store',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@store'
    ]);


    Route::get('/view-all', [
        'as' => 'electricity_units.index',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@index'
    ]);

    Route::get('/edit/{num}', [
        'as' => 'electricity_units.edit',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@edit'
    ]);

    Route::post('/update/{num}', [
        'as' => 'electricity_units.update',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@update'
    ]);

    Route::get('/disable/{num}', [
        'as' => 'electricity_units.disable',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@delete'
    ]);

    Route::get('/electricity-cost', [
        'as' => 'electricity_units.cost',
        //'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@get_cost'
    ]);
    Route::get('/electricity/previous-meter-reading', [
        'as' => 'electricity.previous_reading',
        'middleware' => 'admin',
        'uses' => 'ElectricityUnitsController@previous_reading'
    ]); 
});