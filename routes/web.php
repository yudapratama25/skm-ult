<?php

use App\Http\Controllers\KuesionerController;
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

Route::get('/', [KuesionerController::class, 'showForm']);

Route::get('/responden', [KuesionerController::class, 'showResponden']);
Route::get('/responden/{kuesionerId}', [KuesionerController::class, 'detailResponden']);

Route::post('/submit-kuesioner', [KuesionerController::class, 'submitKuesioner'])->name('submit-kuesioner');
