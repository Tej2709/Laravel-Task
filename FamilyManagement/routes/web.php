<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\User;

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


Route::resource('users',UserController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('approve/{id}',[UserController::class, 'approve'])->name('users.approve');
Route::get('reject/{id}',[UserController::class, 'reject'])->name('users.reject');

Route::get('active/{id}',[UserController::class, 'active'])->name('users.active');
Route::get('inactive/{id}',[UserController::class, 'inactive'])->name('users.inactive');

Route::get('user_export',[UserController::class, 'get_user_data'])->name('users.export');

Route::get('archive',[UserController::class, 'archive'])->name('users.archive');


Route::get ('filterworks',[UserController::class, 'filterworks'])->name('users.filterworks');
