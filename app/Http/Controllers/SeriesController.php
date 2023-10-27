<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all(); //query é uma função do laravel que retorna um objeto do tipo query builder, que é uma classe do laravel que permite fazer consultas no banco de dados. O método orderBy ordena os resultados pelo nome
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

    public function store(SeriesFormRequest $request) //SeriesFormRequest é uma classe que eu criei para validar os dados do formulário
    {
        $serie = DB::transaction(function () use ($request) { //a função transaction inicia uma transação para a gente, executa o código e depois faz o commit e se aqui dentro der algum erro, a própria função já faz o rollback para gente
            $serie = Series::create($request->all());
            $seasons = [];

            for ($i = 1; $i <= $request->seasonsQty; $i++) { //para cada temporada, o $i começa em 1 e vai até o número de temporadas criando-as
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons); //insere as temporadas no banco de dados

            $episodes = [];
            foreach ($serie->seasons as $season) { //para cada temporada, eu crio os episódios (o $serie->seasons é um relacionamento que eu criei no model Series
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) { //para cada episodio, o $j começa em 1 e vai até o número de episódios por temporada
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes); //Nós passamos um array de arrays, onde cada item é um array associativo contendo os valores a serem inseridos no banco de dados.
            return $serie;
        });


        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!"); //to_route é uma função do laravel que redireciona para uma rota e o with é uma função do laravel que cria uma sessão temporária, que dura apenas uma requisição, ou seja, se eu atualizar a página, a mensagem some
    }

    public function destroy(Series $series)
    {
        $series->delete();//delete é um método do laravel que deleta o registro do banco de dados e se ele não acha o registro, ele não faz nada

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso"); //with é um método do laravel que cria uma sessão temporária, que dura apenas uma requisição, ou seja, se eu atualizar a página, a mensagem some
    }

    public function edit(Series $series)
    {
        //dd($series->temporadas); //se eu acessar como se fosse uma propriedade eu acesso a coleção, eu já pego as tempordas. Se eu acessar como se fosse um método (temporadas()), eu acesso o relacionamento, uma possibilidade filtrar isso por exemplo
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all()); //fill é um método do laravel que preenche os campos do objeto com os dados do request (dados do formulário
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
