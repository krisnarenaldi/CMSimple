<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "superadmin" middleware group. Now create something great!
|
*/

Route::get("/","SuperadminController@index");
Route::get("hello/{me}","SuperadminController@hello");
