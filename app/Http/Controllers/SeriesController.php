<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;


class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository) //injeção de dependência, eu estou dizendo que o meu controller precisa de uma instância de SeriesRepository para funcionar, ou seja, eu preciso passar uma instância de SeriesRepository para o meu controller funcionar. Também utiliza inversão de dependência, ou seja, eu não preciso instanciar a classe SeriesRepository, o próprio laravel faz isso para mim
    {
    }

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
        $serie = $this->repository->add($request); //aqui eu chamo o método add da classe EloquentSeriesRepository, que é uma classe que lida com detalhes de banco de dados

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
