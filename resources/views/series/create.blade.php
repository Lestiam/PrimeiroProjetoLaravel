<x-layout title="Nova Série">
    <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false"/> {{--o :action é um atributo, e o route é uma função do laravel que recebe o nome da rota e retorna a url da rota e a função old retorna oq o laravel recebeu antes do ultimo flash--}}
</x-layout>
