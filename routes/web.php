<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/movieSearch', [SearchController::class, 'movieSearch']);
Route::get('/movieSearchDesc', [SearchController::class, 'movieSearchDesc']);
Route::get('/searchResults', [SearchController::class, 'searchResults']);
