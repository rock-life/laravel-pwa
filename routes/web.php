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
    Route::get('/new_song', [\App\Http\Controllers\SongsController::class, 'getPageAddNewSong'])->name('add_new_song');
    Route::get('/get_all_artist', [\App\Http\Controllers\ArtistController::class, 'getArtistByLetters'])->name('get_all_artist');
    Route::post('/addSong', [\App\Http\Controllers\SongsController::class, 'addSongs'])->name('addSong');
    Route::get('/show-song/{id_song}/{id_song_variant}/{type}', [\App\Http\Controllers\SongsController::class, 'getSong'])->name('getSong');
    Route::get('/variant', [\App\Http\Controllers\SongVariantController::class, 'getVariantSong'])->name('getVariantSong');
    Route::get('/variant-text', [\App\Http\Controllers\SongVariantController::class, 'getVariantTextSong'])->name('getVariantTextSong');
    Route::get('/set-save-song' ,[\App\Http\Controllers\SaveSongController::class, 'setSavedSong'])->name('setSavedSong');
    Route::get('/get-save-song' ,[\App\Http\Controllers\SaveSongController::class, 'getSavedSong'])->name('getSavedSong');
    Route::get('/del-save-song', [\App\Http\Controllers\SaveSongController::class, 'delSavedSong'])->name('delSavedSong');
    Route::get('/my-added-song', [\App\Http\Controllers\SongsController::class, 'getMyAddedSong'])->name('getMyAddedSong');

    Route::group(['middleware' =>['guest']], function (){
        Route::get('/registration',[\App\Http\Controllers\UserController::class, 'showRegisterForm'])->name('register.show');
        Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register.perform');

        Route::get('/sign_in',[\App\Http\Controllers\UserController::class, 'showLoginForm'])->name('login');
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
