<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::any('/test', function () {
     return view('admin.appointment.create');
});






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware'=>['auth','admin']],function(){
	Route::resource('doctor','DoctorController');

});

Route::group(['middleware'=>['auth','doctor']],function(){

Route::resource('appointment','AppointmnetController');
Route::post('/appointment/check','AppointmnetController@check')->name('appointment.check');
Route::post('/appointment/update','AppointmnetController@updateTime')->name('update');
	
});

