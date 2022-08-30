<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResortController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckinController;

use App\Models\User;
use App\Models\Game;
use App\Models\Resort;


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

Route::resource('users', UserController::class);
Route::resource('resorts', ResortController::class);
Route::get('resort_export', [ResortController::class, 'get_resort_data'])->name('resort.export');
Route::resource('games', GameController::class);

Route::resource('checkin', CheckinController::class);

Route::get('/filterResort', [App\Http\Controllers\filterController::class, 'filterResort']);
Route::get('/index', [App\Http\Controllers\filterController::class, 'index']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
