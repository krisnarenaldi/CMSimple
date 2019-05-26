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

Route::get('/home', 'HomeController@index')->name('home');



Route::prefix("admin")->name("admin.")->group(function(){
    Route::get("/",function(){
        return view("home");
    })->middleware("auth:admin")->name("home");  
    //Route::match(["get","post"], "/login","AdminController@login")->name("login");
    Route::get("/login","AdminLoginController@showLoginForm");
    Route::post("/login","AdminLoginController@login")->name("login");
    Route::get("/register","AdminRegisterController@getRegister");
    Route::post("/register","AdminRegisterController@postRegister")->name("register");
});