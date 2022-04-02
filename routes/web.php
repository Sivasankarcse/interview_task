<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search-friend', [HomeController::class, 'search_friend'])->name('search-friend');
Route::get('/match-friend', [HomeController::class, 'match_friend'])->name('match-friend');
Route::post('/search_gender', [HomeController::class, 'search_gender'])->name('search_gender');
Route::post('/search_dob', [HomeController::class, 'search_dob'])->name('search_dob');
Route::post('/search_color', [HomeController::class, 'search_color'])->name('search_color');
Route::post('/search_actor', [HomeController::class, 'search_actor'])->name('search_actor');
Route::get('/user-profile/{id}', [HomeController::class, 'user_profile'])->name('user-profile');
Route::post('/add_friend', [HomeController::class, 'add_friend'])->name('add-friend');
