<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ReportController::class,'index'])->name('index');
Route::get('/top', [ReportController::class,'topDistributors'])->name('top');
Route::post('/fetch', [ReportController::class,'fetch'])->name('fetch');
Route::post('/search', [ReportController::class,'search'])->name('search');
Route::get('autocomplete', [ReportController::class,'autocomplete'])->name('autocomplete');


