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
Route::get('/', 'HomeController@HomeIndex')->middleware('loginCheck');
Route::get('/visitor', 'visitorController@visitorIndex')->middleware('loginCheck');

///Hoome serviceController///////////

Route::get('/service', 'serviceController@serviceIndex')->middleware('loginCheck');
Route::get('/getServiceData', 'serviceController@getServiceData')->middleware('loginCheck');
Route::post('/ServiceDelete', 'serviceController@ServiceDelete')->middleware('loginCheck');
Route::post('/ServiceDetails','serviceController@ServiceDetails')->middleware('loginCheck');
Route::post('/ServiceUpdate','serviceController@ServiceUpdate')->middleware('loginCheck');
Route::post('/ServiceAdd','serviceController@ServiceAdd')->middleware('loginCheck');

///HOme CouseController///////////

Route::get('/CourseIndex','CourseController@CourseIndex')->middleware('loginCheck');
Route::get('/GetCourse','CourseController@GetCourse')->middleware('loginCheck');
Route::post('/CourseDetails','CourseController@CourseDetails')->middleware('loginCheck');
Route::post('/Coursedelete','CourseController@Coursedelete')->middleware('loginCheck');
Route::post('/CourseUpdate','CourseController@CourseUpdate')->middleware('loginCheck');
Route::post('/CourseAdd','CourseController@CourseAddd')->middleware('loginCheck');

/// Home Project Controllder///

Route::get('/HomeProject','ProjectController@HomeProject')->middleware('loginCheck');
Route::get('/GetProject','ProjectController@GetProject')->middleware('loginCheck');
Route::post('/projectDelete','ProjectController@projectDelete')->middleware('loginCheck');
Route::post('/ProjectDetails','ProjectController@ProjectDetails')->middleware('loginCheck');
Route::post('/ProjectEdite','ProjectController@ProjectEdite')->middleware('loginCheck');
Route::post('/ProjectAdd','ProjectController@ProjectAdd')->middleware('loginCheck');

// HOme contact Page///

Route::get('/contact','ContactController@ContactIndex')->middleware('loginCheck');
Route::get('/getcontact','ContactController@GetContact')->middleware('loginCheck');
Route::post('/ContactgetDelete','ContactController@ContactgetDelete')->middleware('loginCheck');

//HOme Rivewo page///

Route::get('/RivewIndex','RivewController@RivewIndex')->middleware('loginCheck');
Route::get('/getRivewData', 'RivewController@getRivewData')->middleware('loginCheck');
Route::post('/RivewDelete', 'RivewController@RivewDelete')->middleware('loginCheck');
Route::post('/RivewDetails','RivewController@RivewDetails')->middleware('loginCheck');
Route::post('/RivewUpdate','RivewController@RivewUpdate')->middleware('loginCheck');
Route::post('/RivewAdd','RivewController@RivewAdd')->middleware('loginCheck');

//Login page///
Route::get('/Login','LoginController@login');
Route::post('/onLogin','LoginController@onLogin');



