<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

Route::get('/', [MovieController::class, 'home']);


Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/upmovies', [MovieController::class, 'index'])->name('upmovies.index');
Route::get('/popmovies', [MovieController::class, 'index'])->name('popmovies.index');
Route::get('/topmovies', [MovieController::class, 'index'])->name('topmovies.index');
Route::get('/topseries', [MovieController::class, 'index'])->name('movies.topseries');
Route::get('/atseries', [MovieController::class, 'index'])->name('movies.atseries');
Route::get('/popseries', [MovieController::class, 'index'])->name('movies.popseries');
Route::get('/allmovies/detail/{id}', [ MovieController::class, 'detail']);



Route::get('/search/movie', [SearchController::class, 'index'])->name('msearch.index');
Route::get('/search/series', [SearchController::class, 'index'])->name('ssearch.index');




Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
