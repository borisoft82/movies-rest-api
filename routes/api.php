<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\MovieFilterController;
use App\Http\Controllers\Api\V1\GenreController;
use App\Http\Controllers\Api\V1\FavoriteUserMoviesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'cors'], function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

});

Route::group(['middleware' => 'cors'], function () {

    Route::controller(GenreController::class)->group(function () {
        Route::name('genres.')->prefix('/genres')->group(function () {
            Route::get('/', 'index')->name('get');
            Route::get('/{genre}', 'show')->name('show');
            Route::post('/create', 'store')->name('create');
            Route::put('/update/{genre}', 'update')->name('update');
            Route::delete('/delete/{genre}', 'destroy')->name('delete');     
        });
    });

    Route::controller(MovieController::class)->group(function () {
        Route::name('movies.')->prefix('/movies')->group(function () {
            Route::get('/', 'index')->name('get');
            Route::get('/{movie}', 'show')->name('show');
            Route::post('/create', 'store')->name('create');
            Route::put('/update/{movie}', 'update')->name('update');
            Route::delete('/delete/{movie}', 'destroy')->name('delete');     
        });
    });

    Route::post('movies/filter', MovieFilterController::class)->name('movies.filter');

    Route::post('favorite/user/movies', [FavoriteUserMoviesController::class, 'favoriteMovies'])->name('movies.user');
    Route::post('favorite/movies', [FavoriteUserMoviesController::class, 'addToFavorites'])->name('movies.favorite');

});