<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository//é uma classe que lida com detalhes de banco de dados e implementa uma interface
{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function () use ($request) { //a função transaction inicia uma transação para a gente, executa o código e depois faz o commit e se aqui dentro der algum erro, a própria função já faz o rollback para gente
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
    }
}
