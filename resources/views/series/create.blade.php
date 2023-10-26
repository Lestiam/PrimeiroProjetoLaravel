<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post"> {{--lembra de por o método--}}
        @csrf
        {{--o @ vem do blade --}}
        {{--o @crsf é uma diretiva do blade que gera um token de segurança para evitar ataques de cross-site request forgery--}}
        <div class="mb-3">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
