<?php

use Illuminate\Support\Facades\App;
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

Route::group(['namespace'=>'App\Http\Controllers', 'middleware'=>['lang']], function ()
{
    Route::get('/',[\App\Http\Controllers\Controller::class, 'toHome'])->name('toHome');
    Route::get('/edit_lang',[\App\Http\Controllers\Controller::class, 'editLang']);

    Route::group(['middleware' =>['guest']], function (){
        Route::get('/register',[\App\Http\Controllers\UserController::class, 'showRegisterForm'])->name('register.show');
        Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register.perform');

        Route::get('/login',[\App\Http\Controllers\UserController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[\App\Http\Controllers\UserController::class, 'login'])->name('login.perform');
    });

    Route::group(['middleware'=>['auth']], function (){
        Route::get('/logout',[\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
        Route::middleware(['role:administrator'])->group(function (){
            Route::any('/AminPanel', function (){
                return view('admin_panel.home');})->name('admin_panel');
        });
    });


});
