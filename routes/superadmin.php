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


Route::prefix("superadmin")->name("superadmin.")->group(function(){
    Route::get("/","SuperadminController@index");
    Route::get("mytable","SuperadminController@mytable");

    Route::get("register","SuperadminRegisterController@showRegisterForm");
    Route::post("register","SuperadminRegisterController@postRegister")->name("register");
});


