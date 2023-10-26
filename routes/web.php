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
    return view('welcome');
});

Route::get('/series', [SeriesController::class, 'index']); //index é o nome da função
Route::get('/series/criar', [SeriesController::class, 'create']); //create é o nome da função
Route::post('/series/salvar', [SeriesController::class, 'store']); //store é o nome da função que salva no banco de dados
