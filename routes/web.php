<?php

use App\Http\Controllers\SeasonsController;
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

Route::resource('/series', SeriesController::class)
    ->except(['show']); //mostra todos menos o show

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index'); //mostra todas as temporadas de uma série


//Route::controller(SeriesController::class)->group(function () {
//    Route::get('/series', 'index')->name('series.index'); //index é o nome da função
//    Route::get('/series/criar', 'create')->name('series.create'); //create é o nome da função e o name serve para dar um nome a rota
//    Route::post('/series/salvar', 'store')->name('series.store'); //store é o nome da função que salva no banco de dados
//});
//Route::delete('/series/destroy/{serie}', [SeriesController::class, 'destroy'])
//    ->name('series.destroy'); //o resource não cria a rota de delete, então eu crio ela aqui, passo como parametro a série que eu quero deletar e o método destroy do controller

