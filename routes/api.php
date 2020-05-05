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

// Set all endpoints to use api.response middleware
Route::middleware('api.response')->middleware('client')->middleware('auth:api')->group(function () {
    // Users endpoints
    Route::prefix('/users')->as('users')->group(function () {
        // Users manuals
        Route::prefix('/manuals')->as('.manuals')->group(function () {
            Route::get('{id}', 'UserManualController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
            Route::get('', 'UserManualController@getAllManuals')->middleware('role:superadmin')->name('.getAllManuals');
        });

        // Users news
        Route::prefix('/news')->as('.news')->group(function () {
            Route::get('{id}', 'UserNewsController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
            Route::get('', 'UserNewsController@getAllNews')->middleware('role:admin,superadmin,customer,agent')->name('.getAllNews');
        });

        Route::get('/current', 'UserController@current')->middleware('role:admin,superadmin,customer,agent')->name('.current');
        Route::delete('/{id}', 'UserController@delete')->middleware('role:superadmin')->name('.get');
        Route::get('/{id}', 'UserController@get')->middleware('role:admin,superadmin')->name('.get');
        Route::put('/{id}', 'UserController@update')->middleware('role:admin,superadmin')->name('.update');
        Route::post('', 'UserController@create')->middleware('role:admin,superadmin')->name('.create');
        Route::get('', 'UserController@getAllUsers')->middleware('role:admin,superadmin')->name('.getAllUsers');
    });

    // Customers endpoints
    Route::prefix('/customers')->as('customers')->group(function () {
        Route::get('/{id}', 'CustomerController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
        Route::post('', 'CustomerController@update')->middleware('role:admin,superadmin,customer,agent')->name('.update');
        Route::get('', 'CustomerController@getAllCustomers')->middleware('role:superadmin')->name('.getAllCustomers');
    });

    // Modules endpoints
    Route::prefix('/modules')->as('modules')->group(function () {
        Route::get('/{cf_id}/{mid}', 'ModuleController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
        Route::put('/{cf_id}/{mid}', 'ModuleController@update')->middleware('role:admin,superadmin,customer,agent')->name('.update');
    });

    // Services endpoints
    Route::prefix('/services')->as('services')->group(function () {
        Route::get('/{c_id}/{sg_id?}', 'ServiceController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
        Route::put('/{c_id}/{nr_id}', 'ServiceController@update')->middleware('role:admin,superadmin,customer,agent')->name('.update');
    });

    // ServiceGroup endpoints
    Route::prefix('/servicegroups')->as('services')->group(function () {
        Route::get('/{sg_id}', 'ServiceGroupController@get')->middleware('role:admin,superadmin,customer,agent')->name('.get');
        Route::get('/customer/{c_id}', 'ServiceGroupController@getAllServiceGroups')->middleware('role:admin,superadmin,customer,agent')->name('.getAllServiceGroups');
        Route::put('/{sg_id}', 'ServiceGroupController@update')->middleware('role:admin,superadmin,customer,agent')->name('.update');
    });

    // Statistics endpoints
    Route::prefix('/statistics')->as('statistics')->group(function () {
        Route::get('/customer/{id}/{from}/{to}', 'StatisticsController@getCustomerStatistics')->middleware('role:admin,customer,agent')->name('.customer.get');
    });
});

Route::get('/health', 'HealthController@getHealth');

// Default 404 page
Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
