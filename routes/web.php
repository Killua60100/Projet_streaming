<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
    return view('connexion');
})->name('connexion');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/inscription', function () {
    return view('inscription');
})->name('inscription');

Route::post('/inscription', [UserController::class, 'store'])->name('inscription.store');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/films', function () {
    return view('Films');
})->name('films');

Route::get('/series', function () {
    return view('series');
})->name('series');

Route::get('/favoris', function () {
    return view('favoris');
})->name('favoris');

Route::get('/compte', function () {
    return view('compte');
})->name('compte');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
