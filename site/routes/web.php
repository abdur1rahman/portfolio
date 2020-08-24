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

Route::get('/', 'HomeController@HomeIndex');
Route::post('/contact', 'HomeController@SendContact');

//Page//

Route::get('/', 'HomeController@HomeIndex');

Route::get('/Course', 'CourseController@CoursePage');

Route::get('/project', 'ProjectController@ProjectPage');
Route::get('/Tramas', 'TramsConditions@tramsCondition');
Route::get('/policy', 'Ripaynpolicy@Ripaynpolicy');
Route::get('/Contact', 'ContactController@ContactPage');


