<x-layout title="Editar Série '{{ $serie->nome }}'">
    <x-series.form :action="route('series.update', $serie->id)" :nome="$serie->nome"/> {{--o :action é um atributo, e o route é uma função do laravel que recebe o nome da rota e retorna a url da rota--}}
</x-layout>
