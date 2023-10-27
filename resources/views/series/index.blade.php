<x-layout title="Séries">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar </a>

    @isset($mensagemSucesso)
        {{--Se a mensagem de sucesso estiver definida, ele cria esta div, se não, ele não cria--}}
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
    @endisset

    {{--o x-layout é um componente que está em resources/views/series/components/layout.blade.php--}}
    <ul class="list-group">
        {{-- O ul é o que aparece dentro da tag slot no layout.blade.php--}}
        {{--o $series vem do SeriesController.php, que vem do método index()--}}
        {{--o $series é um array, então o foreach vai percorrer cada item do array e colocar dentro da variável $serie, que vai ser usada dentro do foreach para exibir cada item do array $series--}}
        @foreach ($series as $serie)
            {{--o @ vem do blade --}}
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('seasons.index', $serie->id) }}">
                    {{ $serie->nome }}
                </a>
                <span class="d-flex">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        E
                    </a>

                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2"> {{--cria o botão de exluir a série, pega o id do vídeo que será exluido--}}
                        @csrf
                        @method('DELETE') {{--Informo pro meu sistema que é um Delete--}}
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
                </span>
            </li> {{-- essa sintaxe faz basicamente um ecko  --}}
        @endforeach
    </ul>
</x-layout>
