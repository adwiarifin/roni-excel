<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\TableController;
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

Route::get('/import', [ImportController::class, 'something']);

Route::get('/table', [TableController::class, 'view'])->name('table.view');
Route::get('/table/data', [TableController::class, 'data'])->name('table.data');
