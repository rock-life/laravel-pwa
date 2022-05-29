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
    Route::get('/artists', [\App\Http\Controllers\SongsController::class, 'getPageArtist'])->name('getPageArtist');
    Route::get('/artists-aj', [\App\Http\Controllers\SongsController::class, 'getPageArtistAj'])->name('getPageArtistAj');
    Route::get('/category', [\App\Http\Controllers\GenreController::class, 'getCategory'])->name('getCategory');
    Route::get('/categorySong/{id}', [\App\Http\Controllers\GenreController::class, 'songsCategory'])->name('songsCategory');
    Route::get('/categoryAS', [\App\Http\Controllers\GenreController::class, 'songsCategoryA']);
    Route::get('/get_all_artist', [\App\Http\Controllers\ArtistController::class, 'getArtistByLetters'])->name('get_all_artist');
    Route::post('/addSong', [\App\Http\Controllers\SongsController::class, 'addSongs'])->name('addSong');
    Route::get('/show-song/{id_song}/{id_song_variant}/{type}', [\App\Http\Controllers\SongsController::class, 'getSong'])->name('getSong');
    Route::get('/variant', [\App\Http\Controllers\SongVariantController::class, 'getVariantSong'])->name('getVariantSong');
    Route::get('/variant-text', [\App\Http\Controllers\SongVariantController::class, 'getVariantTextSong'])->name('getVariantTextSong');
    Route::get('/can-edit', [\App\Http\Controllers\SongVariantController::class, 'canEdit']);
    Route::get('/songs',[\App\Http\Controllers\SongsController::class, 'getSongPage'])->name('getSongPage');
    Route::get('/next-page',[\App\Http\Controllers\SongsController::class, 'getSongPageAjax']);
    Route::get('/get_song/{id_song}', [\App\Http\Controllers\SongsController::class, 'getSongShow'])->name('getSongShow');
    Route::post('/search', [\App\Http\Controllers\SongsController::class, 'search'])->name('search');
    Route::get('/song-artist/{id}', [\App\Http\Controllers\SongsController::class, 'songsArtist'])->name('songsArtist');

    Route::group(['middleware' =>['guest']], function (){
        Route::get('/registration',[\App\Http\Controllers\UserController::class, 'showRegisterForm'])->name('register.show');
        Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->name('register.perform');

        Route::get('/sign_in',[\App\Http\Controllers\UserController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[\App\Http\Controllers\UserController::class, 'login'])->name('login.perform');
    });

    Route::group(['middleware'=>['auth']], function (){

        Route::get('/mod-songs', [\App\Http\Controllers\SongVariantController::class, 'getModSongs'])->name('getModSongs');
        Route::get('/mod-songs-page', [\App\Http\Controllers\SongVariantController::class, 'getModSongsAjax'])->name('getModSongsAjax');
        Route::get('/set-save-song' ,[\App\Http\Controllers\SaveSongController::class, 'setSavedSong'])->name('setSavedSong');
        Route::get('/get-save-song' ,[\App\Http\Controllers\SaveSongController::class, 'getSavedSong'])->name('getSavedSong');
        Route::get('/del-save-song', [\App\Http\Controllers\SaveSongController::class, 'delSavedSong'])->name('delSavedSong');
        Route::get('/my-added-song', [\App\Http\Controllers\SongsController::class, 'getMyAddedSong'])->name('getMyAddedSong');
        Route::get('/my-added-song-ajax', [\App\Http\Controllers\SongsController::class, 'getMyAddedSongAjax'])->name('getMyAddedSongAjax');
        Route::get('/del-my-added-song', [\App\Http\Controllers\SongVariantController::class, 'delMyAddedSong'])->name('delMyAddedSong');
        Route::get('/del-song/{id}', [\App\Http\Controllers\SongVariantController::class, 'delSong']);
        Route::post('/edit-song', [\App\Http\Controllers\SongVariantController::class, 'editMyAddedSong'])->name('editMyAddedSong');
        Route::get('/edit-song-page/{id}', [\App\Http\Controllers\SongVariantController::class, 'editSongPage'])->name('editSongPage');
        Route::get('/edit-visibility', [\App\Http\Controllers\SongVariantController::class, 'editSongVisibility'])->name('editSongVisibility');
        Route::get('/logout',[\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
        Route::middleware(['role:administrator'])->group(function (){
            Route::get('/manage-users', [\App\Http\Controllers\UserController::class, 'manageUsers'])->name('manageUsers');
            Route::get('/manage-users-page', [\App\Http\Controllers\UserController::class, 'manageUsersAjax'])->name('manageUsersAjax');
            Route::get('/search-users', [\App\Http\Controllers\UserController::class, 'searchUsers'])->name('searchUsers');
            Route::get('/mod-role', [\App\Http\Controllers\UserController::class, 'setModRole'])->name('setRole');
        });
    });


});
