<?php

use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kuesioner', [KuesionerController::class, 'showForm']);

Route::get('/responden', [KuesionerController::class, 'showResponden']);
Route::get('/responden/{kuesionerId}', [KuesionerController::class, 'detailResponden']);

Route::post('/submit-kuesioner', [KuesionerController::class, 'submitKuesioner'])->name('submit-kuesioner');
Route::post('/submit-login/{type}', [LoginController::class, 'login'])->name('submit-login');
Route::get('/logout', function() {
    session()->flush();
    return redirect('/');
});