<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $request->get('id');
        $series = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];
        //busca um arquivo de visualização e monta a resposta
        return view('series.index')->with('series', $series); //compact serve para passar variáveis para a view com o mesmo nome. O series.index é o nome do arquivo que será buscado na pasta resources/views/series
    }

    public function create()
    {
        return view('series.create');
    }
}
