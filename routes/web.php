<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/series');
});

Route::resource('/series', SeriesController::class);
//Route::controller(SeriesController::class)->group(function () {
//    Route::get('/series', 'index')->name('series.index'); //index é o nome da função
//    Route::get('/series/criar', 'create')->name('series.create'); //create é o nome da função e o name serve para dar um nome a rota
//    Route::post('/series/salvar', 'store')->name('series.store'); //store é o nome da função que salva no banco de dados
//});

