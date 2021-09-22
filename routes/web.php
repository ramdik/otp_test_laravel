<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [DashboardController::class, 'index']);
Route::get('/logout', [DashboardController::class, 'logout']);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/process', [LoginController::class, 'loginProcess']);
Route::get('/signup', [LoginController::class, 'signup']);
Route::post('/signup', [LoginController::class, 'store']);
Route::get('/verify', [LoginController::class, 'verify']);
Route::post('/verify/process', [LoginController::class, 'verifyProcess']);

Route::get('/testing', [TestController::class, 'index']);