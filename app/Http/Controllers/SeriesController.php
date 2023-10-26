<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get(); //query é uma função do laravel que retorna um objeto do tipo query builder, que é uma classe do laravel que permite fazer consultas no banco de dados. O método orderBy ordena os resultados pelo nome
        //dd($series); //dd fignifica dump and die, ou seja, mostra o conteúdo da variável e para a execução do código, ótimo para debugar
        //busca um arquivo de visualização e monta a resposta
        return view('series.index')->with('series', $series); //compact serve para passar variáveis para a view com o mesmo nome. O series.index é o nome do arquivo que será buscado na pasta resources/views/series
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());

        return to_route('series.index'); //to_route é uma função do laravel que redireciona para uma rota
    }
}
