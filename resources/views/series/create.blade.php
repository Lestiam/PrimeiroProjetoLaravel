<x-layout title="Nova Série">
    {{--o :action é um atributo, e o route é uma função do laravel que recebe o nome da rota e retorna a url da rota e a função old retorna oq o laravel recebeu antes do ultimo flash--}}

    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome: </label>
                <input type="text"
                       autofocus
                       id="nome"
                       name="nome"
                       class="form-control"
                       value="{{ old('nome') }}">
            </div>

            <div class="col-2">
                <label for="seasonsQty" class="form-label">Nº Temporadas: </label>
                <input type="text"
                       id="seasonsQty"
                       name="seasonsQty"
                       class="form-control"
                       value="{{ old('seasonsQty') }}">
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps / Temporada: </label>
                <input type="text"
                       id="episodesPerSeason"
                       name="episodesPerSeason"
                       class="form-control"
                       value="{{ old('episodesPerSeason') }}">
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
