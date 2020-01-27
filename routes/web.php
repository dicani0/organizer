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
    return view('auth.login');
});

Auth::routes();
Route::resource('doctors', 'DoctorsController');
Route::resource('subusers', 'SubusersController');
Route::get('/dashboard', 'DashboardController@index');
Route::resource('specializations', 'SpecializationsController');
Route::resource('examinations', 'ExaminationsController');
Route::resource('tasks', 'TasksController');
Route::get('events', 'EventsController@index');
Route::resource('referals', 'ReferalsController');
Route::resource('prescriptions', 'PrescriptionsController');
Route::resource('recommendations', 'RecommendationsController');
//calendar
Route::resource('/calendar', 'EventsController');
Route::get('/addeventurl', 'EventsController@display');
Route::post('events', 'EventsController@addEvent')->name('events.add');


Route::get('subuser/{id}', 'SubusersController@storeToSession')->name('subuser.storeToSession');
