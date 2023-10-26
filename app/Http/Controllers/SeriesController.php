<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get(); //query é uma função do laravel que retorna um objeto do tipo query builder, que é uma classe do laravel que permite fazer consultas no banco de dados. O método orderBy ordena os resultados pelo nome
        $mensagemSucesso = session('mensagem.sucesso'); //atraves da minha sessão, eu estou validando se existe uma mensagem de sucesso, se existir, eu pego ela e passo para a view, se não, ele retorna nulo
        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);

        //dd($series); //dd fignifica dump and die, ou seja, mostra o conteúdo da variável e para a execução do código, ótimo para debugar
        //busca um arquivo de visualização e monta a resposta
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie =  Serie::create($request->all());

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!"); //to_route é uma função do laravel que redireciona para uma rota e o with é uma função do laravel que cria uma sessão temporária, que dura apenas uma requisição, ou seja, se eu atualizar a página, a mensagem some
    }

    public function destroy(Serie $series)
    {
        $series->delete();//delete é um método do laravel que deleta o registro do banco de dados e se ele não acha o registro, ele não faz nada

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso"); //with é um método do laravel que cria uma sessão temporária, que dura apenas uma requisição, ou seja, se eu atualizar a página, a mensagem some
    }

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, Request $request)
    {
        $series->fill($request->all()); //fill é um método do laravel que preenche os campos do objeto com os dados do request (dados do formulário
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
