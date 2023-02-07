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

Route::group(['middleware'=>'auth'], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/client', 'ClientController@index')->name('client');
    Route::group(['prefix'=>'client', 'as' => 'client.'], function() {
        Route::get('/create','ClientController@create')->name('create');
        Route::post('/store','ClientController@store')->name('store');
        Route::get('/edit/{id}','ClientController@edit')->name('edit');
        Route::post('/update/{id}','ClientController@update')->name('update');
        Route::post('/delete','ClientController@delete')->name('delete');
    });
    
    Route::get('/staff', 'StaffController@index')->name('staff');
    Route::group(['prefix'=>'staff', 'as' => 'staff.'], function() {
        Route::get('/create','StaffController@create')->name('create');
        Route::post('/store','StaffController@store')->name('store');
        Route::get('/edit/{id}','StaffController@edit')->name('edit');
        Route::post('/update/{id}','StaffController@update')->name('update');
        Route::post('/delete','StaffController@delete')->name('delete');
    });

    Route::get('/project', 'ProjectController@index')->name('project');
    Route::group(['prefix'=>'project', 'as' => 'project.'], function() {
        Route::get('/create','ProjectController@create')->name('create');
        Route::post('/store','ProjectController@store')->name('store');
        Route::get('/edit/{id}','ProjectController@edit')->name('edit');
        Route::post('/update/{id}','ProjectController@update')->name('update');
        Route::post('/delete','ProjectController@delete')->name('delete');
        Route::post('/status','ProjectController@changeStatus')->name('status');
    });

    Route::get('/setting', 'SettingController@index')->name('setting');
    Route::group(['prefix'=>'setting', 'as' => 'setting.'], function() {
        Route::post('/update','SettingController@update')->name('update');
    });
});
