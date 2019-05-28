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
    //dashboard
    Route::get("/","SuperadminController@index")->name("home");
    Route::get("mytable","SuperadminController@mytable");
    Route::get("profile","SuperadminController@profile")->name("profile");
    Route::post("updateprofile","SuperadminController@updateprofile")->name("updateprofile");

    //logout
    Route::get("register","SuperadminRegisterController@showRegisterForm");
    Route::post("register","SuperadminRegisterController@postRegister")->name("register");

    //login
    Route::get("login","SuperadminLoginController@showLoginForm");
    Route::post("login","SuperadminLoginController@login")->name("login");
    Route::post("logout","SuperadminLoginController@logout")->name("logout");
});


