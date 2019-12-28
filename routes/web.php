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

Auth::routes();

//Route::resource('question','QuestionControllers');
Route::get('/search', 'QuestionControllers@search')->name('search');

Route::get('/', 'QuestionControllers@index');

Route::get('/MyQuestion/create', 'QuestionControllers@create');
Route::get('/MyQuestion/{id}/answer', 'QuestionControllers@answer');
Route::get('/MyQuestion/{id}/destroyanswer', 'QuestionControllers@destroyanswer');
Route::post('/MyQuestion/addanswer', 'QuestionControllers@add');
Route::post('/MyQuestion/add', 'QuestionControllers@store');
Route::get('/MyQuestion/{id}', 'QuestionControllers@show');
Route::get('/MyQuestion/{id}/switchstatus', 'QuestionControllers@switchstatus');
Route::get('/MyQuestion/{id}/edit', 'QuestionControllers@edit');
Route::put('/MyQuestion/{id}/update', 'QuestionControllers@update');
Route::get('/MyQuestion/{id}/delete', 'QuestionControllers@destroy');



