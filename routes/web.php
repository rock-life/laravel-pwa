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

Route::get('/', [\App\Http\Controllers\MainController::class , 'toHome'])->name('home');

Route::get('/reg', [\App\Http\Controllers\UserController::class, 'registrationNewUser'])->name('to_form_registration');

Route::post('/new_user', [\App\Http\Controllers\UserController::class, 'validateRegistrationNewUser'])->name('registration');


Route::get('/sing_in', [\App\Http\Controllers\UserController::class, 'sidnInUser'])->name('sign_in');

Route::post('/sign_in_to_account', function (){
    return bb(Request::all());
})->name('sign_in_to_account');
