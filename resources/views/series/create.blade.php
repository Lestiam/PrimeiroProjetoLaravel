<x-layout title="Nova Série">
    <x-series.form :action="route('series.store')"/> {{--o :action é um atributo, e o route é uma função do laravel que recebe o nome da rota e retorna a url da rota--}}
</x-layout>
